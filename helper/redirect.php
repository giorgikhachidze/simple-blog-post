<?php

class Redirect
{
    private $uri;
    private $message;
    private $status;

    /**
     * @param string $message
     * @param string $uri
     * @param int $status
     */
    public function where(string $message, string $uri, int $status)
    {
        $this->uri     = $uri;
        $this->status  = $status;
        $this->message = $message;

        if ($status === 200) {
            $_SESSION['successMessage'] = $message;
            header('Location: ' . $uri);
            exit;
        } elseif ($status === 400) {
            $_SESSION['errorMessage'] = $message;
            header('Location: ' . $uri);
            exit;
        }
    }
}
