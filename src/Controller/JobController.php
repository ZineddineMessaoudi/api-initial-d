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

/**
* @Route("/api")
*/
class JobController extends AbstractController
{
    /**
     * @Route("/job", name="api_job")
     */
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/JobController.php',
        ]);
    }

    /**
     * @Route("/jobs/create", name="api_job_create", methods={"POST"})
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param ValidatorInterface $validator
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
}
