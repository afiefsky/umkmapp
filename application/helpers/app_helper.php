<?php

function check_session_umkm()
{
    $CI = & get_instance();
    $session = $CI->session->userdata('username');
    if ($session=='admin' || $session=='superadmin' || $session=='')
    {
        redirect('auth');
    }
}

function check_session_admin()
{
    $CI = & get_instance();
    $session = $CI->session->userdata('username');
    if ($session!='admin' || $session!='superadmin' || $session=='')
    {
        redirect('auth');
    }
}

?>
