INSERT INTO odonto.authority (name) VALUES
  ("ROLE_ADMIN"),
  ("ROLE_USER"),
  ("ROLE_CONTRIBUTOR");

INSERT INTO odonto.user (first_name, last_name, username, email, password, avatar_url, bio, active, created_by, created_at, last_modified_by, last_modified_at, deleted) VALUES
  ('System', 'System', 'system', 'system@odonto.com', '$2y$10$bxT9PrVUvYdcJonC1O5ZZ.qBx6BQlYGNQIH8gqBE3G0TQy3aLgfV6', 'https://randomuser.me/api/portraits/women/43.jpg', 'The system', '1', 'system', now(), 'system', now(), '0'),
  ('Admin', 'Istrator', 'admin', 'admin@odonto.com', '$2y$10$73CG8KP7j.yPC6ePA6mjDOxfYHJdu0gRXwb3YGaGn67vqrRSmZw1q', 'https://randomuser.me/api/portraits/women/11.jpg', 'O administrador do sistema', '1', 'system', now(), 'system', now(), '0'),
  ('User', '', 'user', 'user@odonto.com', '$2y$10$ocDVxugauG.bkdMTx2hVcOXINbE7hio/3RblV3B8QlQiNE5K8N2h2', 'https://randomuser.me/api/portraits/women/95.jpg', 'Um usuário comum', '1', 'system', now(), 'system', now(), '0'),
  ('Contributor', '', 'contributor', 'contributor@odonto.com', '$2y$10$dv5F4h5XbVar/6qUa7PqUeKnVWgCfdtoiIV5R9SaZClVrC8wBabuO', 'https://randomuser.me/api/portraits/women/17.jpg', 'Está aqui para contribuir', '1', 'system', now(), 'system', now(), '0');

INSERT INTO odonto.user_has_authority (user_id, authority_id) VALUES
('1', '1'),
('1', '2'),
('1', '3'),
('2', '1'),
('3', '2'),
('4', '3');
