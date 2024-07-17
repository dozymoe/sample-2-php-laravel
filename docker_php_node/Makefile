ifndef UID
	UID = $(shell id -u)
endif
ifndef GID
	GID = $(shell id -g)
endif

PID := php-node

NAME = $(PID).demo

build: ../tmp/.$(PID)-build

stop:

purge:
	-docker rmi $(NAME)
	-rm ../tmp/.$(PID)-build

../tmp/.$(PID)-build: Dockerfile files/boot.sh
	docker build -t $(NAME) --build-arg uid=$(UID) --build-arg gid=$(GID) \
		--file Dockerfile ./
	@touch ../tmp/.$(PID)-build

.PHONY: build stop purge
