#!/bin/bash
mysql -e "DROP DATABASE IF EXISTS Books; CREATE DATABASE Books;"
mysql Books < newBooks.sql
