OptivumToSQL - Parser planów lekcji Optivum do formatu SQL.

Legenda:
	Plik konfiguracyjny - config.php
	Wywo³ywanie programu - index.php


Do poprawnego dzia³ania programu wymagane jest zdefiniowanie w pliku konfiguracyjnym danych do po³¹czenia z utworzon¹ wczeœniej baz¹ danych.

Wymagane jest podanie has³a dostêpu do aplikacji. Mo¿na je zmieniæ w pliku konfiguracyjnym. (domyœlne: 'qwerty')

Dodatkowo mo¿na ustaliæ domyœlny URL do planu lekcji w pliku konfiguracyjnym. Nale¿y uaktualniæ zmienn¹ $dir.


Format koñcowy w tabelach SQL jest nastêpuj¹cy:

	otsql_plan - Tabela ze wszystkimi lekcjami oddzia³u
	otsql_godziny  - Tabela definiuj¹ca godziny trwania konkretnych lekcji


otsql_plan (przyk³adowa tabela)
	__________________________________________________________
	| lekcja | przedmiot | nauczyciel | sala | klasa | dzien |
	----------------------------------------------------------
	|   2    | j.Polski  |     JK     |  8   |   2b  | Wtorek|
	----------------------------------------------------------
	|   6    | Matematyka|     ZS     |  2   |   1a  | Œroda |
	----------------------------------------------------------
	|   4    |  g.wych   |     ZS     |  1   |   3c  | Pi¹tek|
	----------------------------------------------------------

otsql_godziny (przyk³adowa tabela)

	________________________
	|lekcja|poczatek|koniec|
	------------------------
	|   1  | 08:00  | 8:45 |
	-----------------------
	|   2  | 08:50  | 9:35 |
	------------------------
	| .... | ...... | .....|
	------------------------
