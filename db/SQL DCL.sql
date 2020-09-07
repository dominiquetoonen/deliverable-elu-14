CREATE USER 'deliverableAPI'@'%';

SET PASSWORD FOR 'deliverableAPI' = PASSWORD('YcXPXQMl6xiZZe1V');

GRANT SELECT, INSERT, UPDATE, DELETE ON `deliverable` .* TO 'deliverableAPI'@'%'