<?php

namespace App\Helpers;

class MyHelper
{
    public static function formatMessage($message, $type)
    {
    return '<div class="alert alert-' . $type . ' alert-dismissible " role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>'.$message.'</strong>
            </div>';
    }

}