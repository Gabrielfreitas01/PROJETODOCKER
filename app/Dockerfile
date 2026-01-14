# 1. Use uma imagem oficial e específica (versão estável e leve)
FROM php:8.2-apache

# 2. Instala apenas as extensões necessárias (o PHP oficial não vem com mysqli por padrão)
# Otimização: Instala, configura e limpa o cache em uma única camada (layer)
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# 3. Define o diretório de trabalho
WORKDIR /var/www/html

# 4. Copia apenas o necessário (evita lixo do repositório como .git)
COPY index.php .

# 5. Ajusta permissões (Segurança: o servidor web não deve ser dono de tudo com permissão de escrita)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# 6. Metadata para documentação e organização
LABEL maintainer="Seu Nome <seuemail@exemplo.com>"
LABEL version="1.0"
LABEL description="PoC de PHP com Load Balancing para desafio DIO"

# O Apache já está configurado na imagem base para rodar na porta 80 por padrão
EXPOSE 80