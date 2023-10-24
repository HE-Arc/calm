FROM debian:latest
ARG user_id="1000"
ARG grp_id="1000"
RUN apt-get update
RUN apt-get install -y \
  lsb-release \
  ca-certificates \
  apt-transport-https \
  software-properties-common \
  gnupg2 \
  wget
RUN echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/sury-php.list
RUN wget -qO - https://packages.sury.org/php/apt.gpg | apt-key add -
RUN apt-get update
RUN apt-get install -y php8.2
RUN apt-get install -y \
  systemctl\
  libapache2-mod-php\
  php-xdebug\
  php8.2-pdo php-mysql\
  php8.2-curl\
  php8.2-dom\
  php8.2-xml\
  php8.2-curl\
  php8.2-mbstring\
  curl\
  vim\
  git\
  unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get update
RUN apt-get install -y ca-certificates curl gnupg
RUN mkdir -p /etc/apt/keyrings
RUN curl -fsSL https://deb.nodesource.com/gpgkey/nodesource-repo.gpg.key | gpg --dearmor -o /etc/apt/keyrings/nodesource.gpg

ENV NODE_MAJOR=20
RUN echo "deb [signed-by=/etc/apt/keyrings/nodesource.gpg] https://deb.nodesource.com/node_$NODE_MAJOR.x nodistro main" | tee /etc/apt/sources.list.d/nodesource.list

RUN apt-get update
RUN apt-get install nodejs -y

# create user
# RUN groupadd -g $grp_id defaultgrp
# RUN useradd -m -u $user_id defaultuser
# RUN usermod -aG $grp_id $user_id
RUN echo "sail:x:$user_id:$grp_id:sail:/tmp:/bin/bash" >> /etc/passwd  
USER $user_id

COPY ./startup.sh /home/user/startup.sh
ENTRYPOINT []
CMD ["/home/user/startup.sh"]
