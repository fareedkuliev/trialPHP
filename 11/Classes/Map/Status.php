<?php

namespace Classes\Map;

enum Status: int
{
    case Obstacle = 1;
    case Free = 0;
}