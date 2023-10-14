# TODO

## Entities -- DONE

Make all entities needed, with constraints and relations

(look entities.md)

## Routes -- TODO

| URL | HTTP Method | Controller | Method | HTML title | Commentary | Status |
| --- | ------------ | ---------- | ------- | ---------- | ----------- | ------ |
| `/login` | `GET POST` | `LogController` | `login` | Login | Login page | not done |
| `/` | `GET`  | `MainController` | `index`  | Initial D | All main data | not done |
| `/cars` | `GET` | `CarController` | `index` | Initial D cars | All cars data | not done |
| `/create` | `POST` | `CharacterController` | `create` | Create character | create a character | not done |
| `/jobs/create`  | `POST` | `JobController` | `create` | Create job |  Create a job | done |
| `/cars/create` | `POST` | `CarController` | `create` | Create car | Create a car | not done |
| `/cars/update` | `PUT` | `CarController` | `update` | Update car | Update a car | not done |  
| `/jobs/update` | `PUT` | `JobController` | `update` | Update job | Update a job | not done |
| `/characters/update` | `PUT` | `CharacterController`| `update` | Update character | create a character | not done |
| `/cars/delete` | `DELETE` | `CarController` | `delete` | Delete car | Delete a car | not done |  
| `/jobs/delete` | `DELETE` | `JobController` | `delete` | Delete job | Delete a job | not done |
| `/characters/delete` | `DELETE` | `CharacterController`| `delete` | Delete character | Delete a character | not done |  

## create and Update Form -- TODO

Make front forms to create and update entities

## ACL + JWT -- TODO

| Role | Can access | Hierarchy|
| ---- | ---------- | -------- |
| ROLE_ADMIN | All | ROLE_MODERATOR & ROLE_USER |
| ROLE_MODERATOR | All except delete | ROLE_USER |
| ROLE_USER | All except update & delete | PUBLIC_ACCESS |
| PUBLIC_ACESS | Read only | none |