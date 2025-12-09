#Endpoints

| URL          | HTTP method | Auth | JSON Response     |
| ------------ | ----------- | ---- | ----------------- |
| /users/login | POST        |      | user's token      |
| /users       | GET         | Y    | all users         |
| /writers     | GET         |      | all writers       |
| /writers     | POST        | Y    | new author added  |
| /writers     | PATCH       | Y    | edited author     |
| /writers     | DELETE      | Y    | id                |

