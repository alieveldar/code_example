#!/bin/bash
chmod 777 /app/web/assets
chmod 777 /app/runtime
while ! php /app/yii migrate --interactive=0 ; do sleep 1; done 
while ! php /app/yii migrate --interactive=0 --db=test_db; do sleep 1; done 
apache2-foreground