FROM debian:latest
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
  php8.2-pdo php-mysql\
  php8.2-curl\
  php8.2-dom\
  php8.2-xml\
  php8.2-curl\
  curl\
  vim\
  git\
  unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY ./startup.sh /root/startup.sh
ENTRYPOINT []
CMD ["/root/startup.sh"]
