FROM nginx:latest

COPY ./devops/scripts/ /tmp/scripts/
RUN chmod -R 777 /tmp/scripts/

# set timezone
ARG TZ
RUN /tmp/scripts/set_timezone.sh ${TZ}

# add users
ARG APP_USER=www-data
ARG APP_GROUP=www-data
ARG APP_USER_ID=1000
ARG APP_GROUP_ID=1000

RUN /tmp/scripts/create_user.sh ${APP_USER} ${APP_GROUP} ${APP_USER_ID} ${APP_GROUP_ID}

RUN /tmp/scripts/install_software.sh

# nginx config
ARG SERVICE_NAME
COPY ./devops/${SERVICE_NAME}/nginx.conf /etc/nginx/
ARG APP_USER
RUN /tmp/scripts/modify_config.sh /etc/nginx/nginx.conf \
    "__APP_USER" \
    "${APP_USER}" \
 && /tmp/scripts/modify_config.sh /etc/nginx/nginx.conf \
    "__APP_GROUP" \
    "${APP_GROUP}" \
;

# nginx app config
COPY ./devops/${SERVICE_NAME}/sites-available/* /etc/nginx/sites-available/
ARG APP_CODE_PATH
ARG CONF_FILE
RUN /tmp/scripts/modify_config.sh /etc/nginx/sites-available/${CONF_FILE}.conf \
    "__NGINX_ROOT" \
    "${APP_CODE_PATH}" \
;

# workdir
WORKDIR /etc/nginx/

# cleanup
RUN /tmp/scripts/cleanup.sh

CMD ["nginx"]

EXPOSE 80 443