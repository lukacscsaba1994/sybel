<?php

class CommonHelperController {

    public function dd() {
        foreach (func_get_args() as $arg) {
            echo "<pre>";
            var_dump($arg);
            echo "</pre>";
        }
    }
}

?>