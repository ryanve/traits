<?php

call_user_func(function($dir) {
  foreach (glob("$dir/*.php") as $name) require_once "$dir/$name";
}, __DIR__ . '/traits');