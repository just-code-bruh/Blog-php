<?php
    session_start();
    function Message(){
        if(isset($_SESSION["ErrorMessage"])){
            $Output = '<div class="alert alert-danger">';
            $Output .= htmlentities($_SESSION["ErrorMessage"]);
            $Output .= "</div>";
            $_SESSION["ErrorMessage"]=NULL;
            return $Output;
        }
    }
    function SuccessMessage()
    {
        if (isset($_SESSION["SuccessMessage"])) {
            $Output = '<div class="success alert-success">';
            $Output .= htmlentities($_SESSION["SuccessMessage"]);
            $Output .= "</div>";
            $_SESSION["SuccessMessage"] = NULL;
            return $Output;
        }
    }
?>