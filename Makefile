PID := sample3-laravel

NAME = $(PID).demo
NETWORK = internal.demo

run: tmp/.network
	$(MAKE) $(MAKEARGS) -C docker_mysql start args=""
	$(MAKE) $(MAKEARGS) -C docker_php_node build
	docker run -it --rm --network=$(NETWORK) \
		-v $(shell pwd):/var/www/work \
		-p 8080:8000 \
		--name=$(NAME) php-node.demo

mysql: tmp/.network
	$(MAKE) $(MAKEARGS) -C docker_mysql $(cmd) $(args)

tmp/.network:
	-@docker network create $(NETWORK)
	@touch tmp/.network

stop:
	-docker stop -t60 $(NAME)
	-$(MAKE) -C docker_mysql stop

purge:
	-docker stop -t60 $(NAME)
	-docker rm $(NAME)
	-rm tmp/.$(PID)-build
	-$(MAKE) -C docker_mysql purge
	-$(MAKE) -C docker_php_node purge
	-docker network rm $(NETWORK)
	-rm tmp/.network

include Makefile-commands.in

.PHONY: mysql
.PHONY: run stop purge
