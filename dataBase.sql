SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
--
-- Banco de dados: `agenda`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `contatos`
--

CREATE TABLE `contatos` (
  `idContato` int(11) NOT NULL,
  `nomeContato` varchar(200) DEFAULT NULL,
  `emailContato` varchar(200) DEFAULT NULL,
  `telefoneContato` varchar(50) DEFAULT NULL,
  `sexoContato` varchar(15) DEFAULT NULL,
  `dataNascimentoContato` date DEFAULT NULL,
  `flagFavoritoContato` tinyint(1) DEFAULT NULL,
  `fotoContato` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `contatos`
--
INSERT INTO `contatos` (`idContato`, `nomeContato`, `emailContato`, `telefoneContato`, `sexoContato`, `dataNascimentoContato`, `flagFavoritoContato`, `fotoContato`) VALUES
(1, 'Ana Clara', 'ana.clara@example.com', '(11) 98765-4321', 'Feminino', '1995-06-15', 1, 'ana.jpg'),
(2, 'Carlos Silva', 'carlos.silva@example.com', '(21) 99876-5432', 'Masculino', '1988-11-22', 0, 'carlos.jpg'),
(3, 'Mariana Santos', 'mariana.santos@example.com', '(31) 91234-5678', 'Feminino', '1992-03-10', 1, 'mariana.jpg'),
(4, 'João Pedro', 'joao.pedro@example.com', '(41) 92345-6789', 'Masculino', '1990-01-25', 0, 'joao.jpg'),
(5, 'Fernanda Costa', 'fernanda.costa@example.com', '(51) 93456-7890', 'Feminino', '1996-09-05', 1, 'fernanda.jpg'),
(6, 'Lucas Almeida', 'lucas.almeida@example.com', '(61) 94567-8901', 'Masculino', '1985-04-17', 0, 'lucas.jpg'),
(7, 'Rafael Oliveira', 'rafael.oliveira@example.com', '(71) 95678-9012', 'Masculino', '1993-07-09', 1, 'rafael.jpg'),
(8, 'Gabriela Mendes', 'gabriela.mendes@example.com', '(81) 96789-0123', 'Feminino', '1997-12-30', 0, 'gabriela.jpg'),
(9, 'Paulo Henrique', 'paulo.henrique@example.com', '(91) 97890-1234', 'Masculino', '1986-08-11', 1, 'paulo.jpg'),
(10, 'Juliana Rocha', 'juliana.rocha@example.com', '(31) 98901-2345', 'Feminino', '1994-02-19', 0, 'juliana.jpg'),
(11, 'Ricardo Lima', 'ricardo.lima@example.com', '(41) 90012-3456', 'Masculino', '1989-05-03', 1, 'ricardo.jpg'),
(12, 'Camila Batista', 'camila.batista@example.com', '(21) 91123-4567', 'Feminino', '1991-10-21', 0, 'camila.jpg'),
(13, 'Felipe Andrade', 'felipe.andrade@example.com', '(51) 92234-5678', 'Masculino', '1987-06-07', 1, 'felipe.jpg'),
(14, 'Larissa Matos', 'larissa.matos@example.com', '(61) 93345-6789', 'Feminino', '1993-12-14', 0, 'larissa.jpg'),
(15, 'André Barbosa', 'andre.barbosa@example.com', '(71) 94456-7890', 'Masculino', '1990-08-27', 1, 'andre.jpg'),
(16, 'Isabela Ribeiro', 'isabela.ribeiro@example.com', '(81) 95567-8901', 'Feminino', '1992-03-06', 0, 'isabela.jpg'),
(17, 'Thiago Martins', 'thiago.martins@example.com', '(91) 96678-9012', 'Masculino', '1995-11-02', 1, 'thiago.jpg'),
(18, 'Letícia Ferreira', 'leticia.ferreira@example.com', '(31) 97789-0123', 'Feminino', '1989-01-18', 0, 'leticia.jpg'),
(19, 'Diego Gomes', 'diego.gomes@example.com', '(41) 98890-1234', 'Masculino', '1994-04-09', 1, 'diego.jpg'),
(20, 'Sabrina Souza', 'sabrina.souza@example.com', '(21) 99901-2345', 'Feminino', '1996-07-29', 0, 'sabrina.jpg');


-- --------------------------------------------------------

--
-- Estrutura para tabela `eventos`
--

CREATE TABLE `eventos` (
  `idEvento` int(11) NOT NULL,
  `tituloEvento` varchar(255) NOT NULL,
  `descricaoEvento` text NOT NULL,
  `dataInicioEvento` date NOT NULL,
  `dataFimEvento` date NOT NULL,
  `horaInicioEvento` time DEFAULT NULL,
  `horaFimEvento` time DEFAULT NULL,
  `statusEvento` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `eventos`
--

INSERT INTO `eventos` (`idEvento`, `tituloEvento`, `descricaoEvento`, `dataInicioEvento`, `dataFimEvento`, `horaInicioEvento`, `horaFimEvento`, `statusEvento`) VALUES
(1, 'Workshop de Tecnologia', 'Evento para discutir inovações tecnológicas.', '2025-02-10', '2025-02-10', '09:00:00', '17:00:00', '1'),
(2, 'Hackathon 2025', 'Competição de programação para desenvolver soluções.', '2025-03-15', '2025-03-16', '08:00:00', '20:00:00', '1'),
(3, 'Palestra de IA', 'Explorando o impacto da inteligência artificial.', '2025-01-20', '2025-01-20', '18:00:00', '20:00:00', '0'),
(4, 'Feira de Startups', 'Apresentação de ideias inovadoras.', '2025-04-05', '2025-04-06', '10:00:00', '18:00:00', '1'),
(5, 'Treinamento em Cloud Computing', 'Sessão prática sobre nuvem.', '2025-05-12', '2025-05-14', '09:00:00', '16:00:00', '1'),
(6, 'Congresso de Sustentabilidade', 'Discussão sobre tecnologia e meio ambiente.', '2025-06-01', '2025-06-03', '09:30:00', '18:00:00', '1'),
(7, 'Encontro de Devs', 'Networking e troca de conhecimentos.', '2025-07-20', '2025-07-20', '10:00:00', '15:00:00', '1'),
(8, 'Lançamento de Produto', 'Apresentação de nova solução tecnológica.', '2025-08-05', '2025-08-05', '14:00:00', '16:00:00', '1'),
(9, 'Hack Day', 'Desafio rápido de programação.', '2025-08-15', '2025-08-15', '08:00:00', '18:00:00', '1'),
(10, 'Seminário de Blockchain', 'Entendendo o futuro do Blockchain.', '2025-09-10', '2025-09-11', '09:00:00', '16:00:00', '1'),
(11, 'Curso de Machine Learning', 'Aprenda a criar modelos de aprendizado.', '2025-09-20', '2025-09-24', '09:00:00', '12:00:00', '1'),
(12, 'Hackathon Escolar', 'Estudantes criando soluções para a educação.', '2025-10-10', '2025-10-12', '08:00:00', '18:00:00', '1'),
(13, 'Congresso de Robótica', 'Inovação no desenvolvimento de robôs.', '2025-10-25', '2025-10-27', '10:00:00', '17:00:00', '0'),
(14, 'Conferência de Programação', 'Exploração de novas linguagens.', '2025-11-10', '2025-11-12', '09:00:00', '17:00:00', '1'),
(15, 'Maratona de UX/UI', 'Foco em experiência e interface do usuário.', '2025-11-20', '2025-11-20', '13:00:00', '19:00:00', '1'),
(16, 'Oficina de DevOps', 'Automatize processos com DevOps.', '2025-12-05', '2025-12-06', '09:00:00', '15:00:00', '1'),
(17, 'Treinamento de Cybersecurity', 'Mantenha seus sistemas seguros.', '2025-12-10', '2025-12-14', '09:00:00', '17:00:00', '1'),
(18, 'Fórum de Realidade Virtual', 'Discussão sobre o impacto da VR.', '2025-12-20', '2025-12-21', '10:00:00', '16:00:00', '0'),
(19, 'Desafio de Desenvolvimento', 'Criação de aplicativos em tempo limitado.', '2025-12-25', '2025-12-26', '08:00:00', '20:00:00', '1'),
(20, 'Webinar sobre Java', 'Explorando o futuro do Java.', '2025-01-30', '2025-01-30', '19:00:00', '21:00:00', '1');


-- --------------------------------------------------------

--
-- Estrutura para tabela `tarefas`
--

CREATE TABLE `tarefas` (
  `idTarefa` int(11) NOT NULL,
  `tituloTarefa` varchar(255) NOT NULL,
  `descricaoTarefa` text NOT NULL,
  `dataConclusaoTarefa` date NOT NULL,
  `horaConclusaoTarefa` time DEFAULT NULL,
  `dataLembreteTarefa` date DEFAULT NULL,
  `horaLembreteTarefa` time DEFAULT NULL,
  `recorrenciaTarefa` int(11) DEFAULT NULL,
  `statusTarefa` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tarefas`
--
INSERT INTO `tarefas` (`idTarefa`, `tituloTarefa`, `descricaoTarefa`, `dataConclusaoTarefa`, `horaConclusaoTarefa`, `dataLembreteTarefa`, `horaLembreteTarefa`, `recorrenciaTarefa`, `statusTarefa`) VALUES
(1, 'Revisar relatório mensal', 'Verificar os dados do relatório de desempenho.', '2025-01-15', '15:00:00', '2025-01-14', '14:00:00', 0, '0'),
(2, 'Enviar e-mail para cliente', 'Atualizar cliente sobre o andamento do projeto.', '2025-01-16', '10:00:00', '2025-01-15', '09:00:00', 0, '0'),
(3, 'Backup do servidor', 'Realizar backup completo do servidor.', '2025-01-20', '23:00:00', '2025-01-20', '22:30:00', 7, '1'),
(4, 'Planejar reunião semanal', 'Definir pauta e agendar reunião com equipe.', '2025-01-18', '11:00:00', '2025-01-17', '10:30:00', 0, '0'),
(5, 'Atualizar software', 'Instalar a nova versão do sistema.', '2025-01-19', '16:00:00', '2025-01-19', '15:00:00', 30, '1'),
(6, 'Revisão de código', 'Realizar revisão no código do novo módulo.', '2025-01-21', '17:00:00', '2025-01-20', '16:30:00', 0, '0'),
(7, 'Reunião com fornecedor', 'Discutir prazos e entregas.', '2025-01-22', '14:00:00', '2025-01-21', '13:30:00', 0, '1'),
(8, 'Enviar orçamento', 'Elaborar e enviar orçamento para cliente.', '2025-01-23', '12:00:00', '2025-01-22', '11:30:00', 0, '0'),
(9, 'Treinamento da equipe', 'Organizar treinamento sobre novas ferramentas.', '2025-01-25', '09:00:00', '2025-01-24', '08:30:00', 0, '1'),
(10, 'Responder solicitações', 'Atender solicitações pendentes de clientes.', '2025-01-26', '10:00:00', '2025-01-25', '09:30:00', 0, '0'),
(11, 'Análise de dados', 'Gerar relatório com dados atualizados.', '2025-01-27', '14:30:00', '2025-01-26', '14:00:00', 0, '0'),
(12, 'Renovar licença de software', 'Verificar validade e renovar licença.', '2025-01-28', '16:00:00', '2025-01-27', '15:30:00', 365, '1'),
(13, 'Preparar apresentação', 'Criar slides para reunião trimestral.', '2025-01-30', '11:00:00', '2025-01-29', '10:30:00', 0, '0'),
(14, 'Limpeza do sistema', 'Excluir arquivos temporários e otimizar sistema.', '2025-01-31', '18:00:00', '2025-01-31', '17:30:00', 30, '1'),
(15, 'Atualizar documentos', 'Revisar e atualizar políticas internas.', '2025-02-01', '16:00:00', '2025-01-31', '15:30:00', 0, '0'),
(16, 'Relatório financeiro', 'Gerar relatório financeiro para o trimestre.', '2025-02-05', '17:00:00', '2025-02-04', '16:30:00', 0, '0'),
(17, 'Manutenção preventiva', 'Realizar manutenção nos equipamentos.', '2025-02-10', '10:00:00', '2025-02-09', '09:30:00', 90, '1'),
(18, 'Avaliação de desempenho', 'Revisar metas da equipe para o mês.', '2025-02-15', '15:00:00', '2025-02-14', '14:30:00', 0, '0'),
(19, 'Revisar contrato', 'Verificar detalhes de contrato com parceiro.', '2025-02-20', '14:00:00', '2025-02-19', '13:30:00', 0, '0'),
(20, 'Testar nova funcionalidade', 'Testar nova funcionalidade do sistema.', '2025-02-25', '16:00:00', '2025-02-24', '15:30:00', 0, '1');


-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices de tabela `contatos`
--
ALTER TABLE `contatos`
  ADD PRIMARY KEY (`idContato`);

--
-- Índices de tabela `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`idEvento`);

--
-- Índices de tabela `tarefas`
--
ALTER TABLE `tarefas`
  ADD PRIMARY KEY (`idTarefa`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--
--
-- AUTO_INCREMENT de tabela `contatos`
--
ALTER TABLE `contatos`
  MODIFY `idContato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2510;

--
-- AUTO_INCREMENT de tabela `eventos`
--
ALTER TABLE `eventos`
  MODIFY `idEvento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT de tabela `tarefas`
--
ALTER TABLE `tarefas`
  MODIFY `idTarefa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;
