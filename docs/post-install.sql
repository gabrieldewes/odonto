INSERT INTO odonto.authority (name) VALUES
  ("ROLE_USER"),
  ("ROLE_ADMIN"),
  ("ROLE_CONTRIBUTOR");

INSERT INTO odonto.user (first_name, last_name, username, email, password, active, created_by, created_at, last_modified_by, last_modified_at, deleted) VALUES
  ('User', '', 'user', 'user@admin.com', '$2y$10$ocDVxugauG.bkdMTx2hVcOXINbE7hio/3RblV3B8QlQiNE5K8N2h2',   '1', 'system', now(), 'system', now(), '0'),
  ('Admin', 'Istrator', 'admin', 'admin@admin.com', '$2y$10$73CG8KP7j.yPC6ePA6mjDOxfYHJdu0gRXwb3YGaGn67vqrRSmZw1q', '1', 'system', now(), 'system', now(), '0'),
  ('Contributor', '', 'contributor', 'contributor@admin.com', '$2y$10$dv5F4h5XbVar/6qUa7PqUeKnVWgCfdtoiIV5R9SaZClVrC8wBabuO', '1', 'system', now(), 'system', now(), '0');

INSERT INTO odonto.user_has_authority (user_id, authority_id) VALUES
('1', '1'),
('2', '2'),
('3', '3');
