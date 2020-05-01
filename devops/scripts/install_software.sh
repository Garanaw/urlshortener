#!/bin/sh

apt-get update -yqq && apt-get install -yqq \
    build-essential \
    apt-utils \
    curl libcurl4-openssl-dev \
    dnsutils \
    gdb \
    git \
    htop \
    iproute2 \
    iputils-ping \
    ltrace \
    make \
    procps \
    strace \
    sudo \
    sysstat \
    zip unzip \
    vim \
    wget \
;
