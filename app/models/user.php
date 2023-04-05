<?php

namespace Models;
class User
{
    public int $id;
    public string $firstname;
    public string $lastname;
    public string $email;
    public int $type_id;
    public string $password;
    public int $job_type;
    public string $job_name;
    public ?string $certificate;
}
?>