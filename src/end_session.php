<?php
/**
 * Created by IntelliJ IDEA.
 * User: maxime
 * Date: 17/01/18
 * Time: 14:01
 */
session_start();

session_unset();
session_destroy();

header('Location: connect.html');