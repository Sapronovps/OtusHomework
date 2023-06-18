FROM nginx:stable-alpine

ARG gid
ARG uid

ENV uid=${uid}
ENV gid=${gid}

RUN delgroup dialout

RUN addgroup -g ${gid} --system sound
RUN adduser -G sound --system -D -s /bin/sh -u ${uid} sound
RUN sed -i "s/user nginx/user sound/g" etc/nginx/nginx.conf

ADD ./default.conf /etc/nginx/conf.d

RUN mkdir -p /var/www/html