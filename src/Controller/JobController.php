<?php

namespace App\Controller;

use App\Entity\Job;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

/**
* @Route("/api")
*/
class JobController extends AbstractController
{
    /**
     * @Route("/jobs", name="api_job"), methods={"GET"})
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function index(EntityManagerInterface $em): JsonResponse
    {
        $jobs = $em->getRepository(Job::class)->findAll();
        if (count($jobs) === 0) {
            return $this->json(['message' => 'No jobs found.'], Response::HTTP_NOT_FOUND);
        }

        return $this->json($jobs, Response::HTTP_OK, [], ['groups' => 'job']);
    }

    /**
     * @Route("/jobs/create", name="api_job_create", methods={"POST"})
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param ValidatorInterface $validator
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function create(Request $request, EntityManagerInterface $em, ValidatorInterface $validator, SerializerInterface $serializer): JsonResponse
    {
        $data = $request->getContent();
        $job = $serializer->deserialize($data, Job::class, 'json', ['groups' => 'job']);

        $name = $job->getName();
        $existingJob = $em->getRepository(Job::class)->findOneBy(['name' => $name]);

        if ($existingJob !== null) {
            return $this->json(['conflictMessage' => 'The name is already in use.'], Response::HTTP_CONFLICT);
        }

        $errors = $validator->validate($job);
        
        if (count($errors) > 0) {
            return $this->json($errors->get(0)->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $em->persist($job);
        $em->flush();

        return $this->json($job, Response::HTTP_CREATED, [], ['groups' => 'job']);
    }

    /**
     * @Route("/jobs/update/{id}", name="api_job_update", methods={"PUT"})
     * @param int $id
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param SerializerInterface $serializer
     * @param ValidatorInterface $validator
     * @return JsonResponse
     */
    public function update($id, Request $request, EntityManagerInterface $em, SerializerInterface $serializer, ValidatorInterface $validator): JsonResponse
    {
        $job = $em->getRepository(Job::class)->find($id);

        if ($job === null) {
            return $this->json(['message' => 'Job not found.'], Response::HTTP_NOT_FOUND);
        }

        $data = $request->getContent();
        $serializer->deserialize($data, Job::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $job]);

        $errors = $validator->validate($job);

        if (count($errors) > 0) {
            return $this->json($errors->get(0)->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $em->flush();

        return $this->json($job, Response::HTTP_OK, [], ['groups' => 'job']);
    }

    /**
     * @Route("/jobs/delete/{id}", name="api_job_delete", methods={"DELETE"})
     * @param int $id
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function delete($id, EntityManagerInterface $em): JsonResponse
    {
        $job = $em->getRepository(Job::class)->find($id);

        if ($job === null) {
            return $this->json(['message' => 'Job not found.'], Response::HTTP_NOT_FOUND);
        }

        $em->remove($job);
        $em->flush();

        return $this->json(['message' => 'Job deleted.'], Response::HTTP_ACCEPTED);
    }
}
