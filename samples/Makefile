PHJOSH = ../phjosh.php

.php.js:
	$(PHJOSH) $< > $@

all: sample1.js sample2.js sample3.js sample4.js

clean:
	rm -f sample1.js sample2.js sample3.js sample4.js

.PHONY: all
.SUFFIXES: .php .js
