<?php

namespace Dukrl\Prototype\Example;

class Email {

    private $author;

    private $subject;

    private $body;

    private $note = [];

    private $date;

    public function __construct(String $subject, String $body, Author $author) {
        $this->subject = $subject;
        $this->body = $body;
        $this->author = $author;
        $this->author->addContentEmail($this);
        $this->date = new \DateTime();
    }

    public function addNote(String $note) {
        $this->note[] = $note;
    }

    public function __clone() {
        $this->subject = "Copy of " . $this->subject;
        $this->author->addContentEmail($this);
        $this->note = [];
        $this->date = new \DateTime();
    }
}

class Author {

    private $name;

    private $content = [];

    public function __construct(String $name) {
        $this->name = $name;
    }

    public function addContentEmail(Email $email) : void {
        $this->content[] = $email;
    }
}

function FrontCode() {
    $author = new Author('Eduardo da Silva');
    $mail = new Email('Assunto do email', 'Corpo do email meramente para teste', $author);

    $mail->addNote('Vamos clonar o objeto');

    print_r($mail);

    echo "----------------------------------------------------------------\n\n";

    $cloneObjectMail = clone $mail;
    echo "Esse é o objeto clonado - ";
    print_r($cloneObjectMail);
}

FrontCode();
