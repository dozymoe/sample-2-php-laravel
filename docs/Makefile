# VARIABLES

erd-svg-files = $(patsubst %.puml, %.svg, ERD/*.puml)

# RULES

all: $(erd-svg-files)

ERD/%.svg: ERD/%.puml
	plantuml -tsvg $<
