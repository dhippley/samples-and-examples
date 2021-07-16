#!/bin/bash

docker exec -it $(docker ps | grep 'phx_docker_template_web' | awk '{print $1}') /bin/bash