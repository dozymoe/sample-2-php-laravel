ifndef UID
	UID = $(shell id -u)
endif
ifndef GID
	GID = $(shell id -g)
endif

PID := plantuml

NAME = $(PID).demo

run: ../tmp/.$(PID)-build
	docker run --rm \
		-v $(shell pwd)/..:/home/user/work \
		$(NAME) \
		make -C docs

stop:

purge:
	-docker rmi $(NAME)
	-rm ../tmp/.$(PID)-build

../tmp/.$(PID)-build: Dockerfile
	docker build -t $(NAME) --build-arg uid=$(UID) --build-arg gid=$(GID) \
		--file Dockerfile ./
	@touch ../tmp/.$(PID)-build

.PHONY: run stop purge
