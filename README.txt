OptivumToSQL - Parser plan�w lekcji Optivum do formatu SQL.

Legenda:
	Plik konfiguracyjny - config.php
	Wywo�ywanie programu - index.php


Do poprawnego dzia�ania programu wymagane jest zdefiniowanie w pliku konfiguracyjnym danych do po��czenia z utworzon� wcze�niej baz� danych.

Wymagane jest podanie has�a dost�pu do aplikacji. Mo�na je zmieni� w pliku konfiguracyjnym. (domy�lne: 'qwerty')

Dodatkowo mo�na ustali� domy�lny URL do planu lekcji w pliku konfiguracyjnym. Nale�y uaktualni� zmienn� $dir.


Format ko�cowy w tabelach SQL jest nast�puj�cy:

	otsql_plan - Tabela ze wszystkimi lekcjami oddzia�u
	otsql_godziny  - Tabela definiuj�ca godziny trwania konkretnych lekcji


otsql_plan (przyk�adowa tabela)
	__________________________________________________________
	| lekcja | przedmiot | nauczyciel | sala | klasa | dzien |
	----------------------------------------------------------
	|   2    | j.Polski  |     JK     |  8   |   2b  | Wtorek|
	----------------------------------------------------------
	|   6    | Matematyka|     ZS     |  2   |   1a  | �roda |
	----------------------------------------------------------
	|   4    |  g.wych   |     ZS     |  1   |   3c  | Pi�tek|
	----------------------------------------------------------

otsql_godziny (przyk�adowa tabela)

	________________________
	|lekcja|poczatek|koniec|
	------------------------
	|   1  | 08:00  | 8:45 |
	-----------------------
	|   2  | 08:50  | 9:35 |
	------------------------
	| .... | ...... | .....|
	------------------------
