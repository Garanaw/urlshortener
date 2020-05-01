ARG PHP_VERSION
FROM php:${PHP_VERSION}-fpm

COPY ./devops/scripts/ /tmp/scripts/
RUN chmod +x -R /tmp/scripts/

# set timezone
ARG TZ
RUN /tmp/scripts/set_timezone.sh ${TZ}

# add users
ARG APP_USER
ARG APP_GROUP
ARG APP_USER_ID
ARG APP_GROUP_ID

RUN /tmp/scripts/create_user.sh ${APP_USER} ${APP_GROUP} ${APP_USER_ID} ${APP_GROUP_ID}

RUN /tmp/scripts/install_software.sh

RUN /tmp/scripts/install_php_extensions.sh

# php config
COPY ./devops/php/conf.d/*  /usr/local/etc/php/conf.d/

# php-fpm pool config
ARG SERVICE_NAME
ARG LOCAL_IP
COPY ./devops/${SERVICE_NAME}/php-fpm.d/* /usr/local/etc/php-fpm.d

RUN /tmp/scripts/modify_config.sh /usr/local/etc/php-fpm.d/zz-app.conf \
    "__APP_USER" \
    "${APP_USER}" \
 && /tmp/scripts/modify_config.sh /usr/local/etc/php-fpm.d/zz-app.conf \
    "__APP_GROUP" \
    "${APP_GROUP}" \
 && /tmp/scripts/modify_config.sh /usr/local/etc/php/conf.d/xdebug.ini \
 	"__LOCAL_IP" \
 	"${LOCAL_IP}" \
 && /tmp/scripts/modify_config.sh /usr/local/etc/php/conf.d/xdebug.ini \
 	"__ZEND_EXTENSION" \
 	"$(find /usr/local/lib/php/extensions/ -name xdebug.so)" \
;

# Install composer and nodejs
RUN /tmp/scripts/install_package_managers.sh

# workdir
ARG APP_CODE_PATH
WORKDIR "$APP_CODE_PATH"

# entrypoint
RUN mkdir -p /bin/docker-entrypoint/ \
 && cp /tmp/scripts/docker-entrypoint/* /bin/docker-entrypoint/ \
 && chmod +x -R /bin/docker-entrypoint/ \
;

RUN /tmp/scripts/cleanup.sh

ENTRYPOINT ["/bin/docker-entrypoint/resolve-docker-host-ip.sh","php-fpm"]
EXPOSE 9000
