<?php
    $keyboard = [
                    "one_time" => false,
                    "buttons" => [[
                    ["action" => [
                    "type" => "text",
                    "payload" => '{"button": "1"}',
                    "label" => "Овощи?"],
                    "color" => "default"],
                ]]];
echo json_encode($keyboard);