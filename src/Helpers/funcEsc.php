<?php

function esc(string $str,$con)
{
  return mysqli_real_escape_string(htmlspecialchars(trim ($str)),$con);
}
