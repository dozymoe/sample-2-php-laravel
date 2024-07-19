FROM debian:stable-slim

ARG uid=1000
ARG gid=1000

# These files can become huge, gigabytes, bug in docker
# See: https://github.com/sagemathinc/cocalc/issues/2287
RUN rm /var/log/faillog /var/log/lastlog

RUN apt update && apt install -y \
    make plantuml

RUN apt-get autoclean -y && rm -rf /var/lib/apt/lists/*

RUN groupadd -g $gid mygroup
RUN useradd -G root -u $uid -g $gid -d /home/user -m -s /bin/bash myuser
RUN mkdir -p /home/user/work && chown -R myuser:mygroup /home/user
RUN mkdir -p /tmp/log && chown -R myuser:mygroup /tmp/log

USER myuser:mygroup
WORKDIR /home/user/work
