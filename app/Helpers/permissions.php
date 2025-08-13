<?php

function permissions(array $permissions): string
{
    return 'permission:'.implode('|', $permissions);
}
