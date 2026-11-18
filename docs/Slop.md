# Caduceus v1 – plan technologiczny i organizacja projektu

Na podstawie opisu projektu oraz przesłanych plików proponuję oprzeć pierwszą wersję Caduceusa na lokalnej aplikacji internetowej, dostępnej z przeglądarki na komputerze przychodni.

To rozwiązanie pozwoli Wam pracować we dwójkę, oddzielić interfejs od bazy danych i stopniowo rozwijać projekt.

## 1. Analiza założeń i plików

### Cel projektu

Caduceus ma umożliwiać administratorom przychodni:

- rejestrowanie pacjentów,
- wyszukiwanie dostępnych terminów,
- rezerwowanie wizyt,
- przydzielanie pomieszczeń,
- zarządzanie wyposażeniem,
- modyfikowanie planu wizyt w trakcie dnia.

### Zakres MVP

| ID  | Funkcjonalność                   | Widok |
| --- | -------------------------------- | ----- |
| F01 | Zarządzanie wyposażeniem         | W03   |
| F02 | Rezerwowanie wizyt               | W02   |
| F03 | Wyświetlanie wolnych terminów    | W01   |
| F04 | Wyświetlanie wolnych pomieszczeń | W02   |
| F05 | Zmiana planu dnia                | W02   |

Zgodnie z plikiem `roadmap-v1.md` funkcja F06 jest przewidziana na v2, a F08 wymaga w przyszłości osobnego widoku danych pacjenta. Nie włączałbym ich do obecnego MVP.

### Analiza pliku bazy danych

Przesłany `BAZA_DANYCH_PSI.mwb` jest modelem MySQL Workbench. Zawiera 12 tabel:

- Pracownik
- Pacjent
- Wizyta
- Rejestracja
- Wyposażenie
- Producent
- Raport Naprawy
- Rezerwacja Wyposażenia
- Rezerwacja Wyposażenia_has_Wyposażenie
- Wizyta_has_Wyposażenie
- Recepta
- Skierowanie

Ważne – brakujący element modelu

W obecnym modelu nie widzę tabeli opisującej pomieszczenia. Nie ma również kompletnego modelu dostępności terminów i czasu trwania wizyty.

To oznacza, że przed implementacją F02, F03 i F04 trzeba będzie rozszerzyć bazę danych, np. o:

- `Pomieszczenie` – gabinet, numer, pojemność lub opis;
- `Termin` – data, godzina rozpoczęcia i zakończenia;
- odpowiednie powiązania wizyty z lekarzem i pomieszczeniem.

Nie warto jeszcze pisać funkcji rezerwacji bez ustalenia tych relacji.

## 2. Dwa proponowane zestawy technologii

Oba warianty zakładają bezpłatne oprogramowanie i pracę lokalną.

### Wariant A – PHP + MySQL + HTML/CSS



Rekomendowany

Najprostszy dla MVP



Przeglądarka internetowa

Interfejs użytkownika

Apache + PHP

Obsługa logiki aplikacji i rezerwacji

MySQL

Przechowywanie danych projektu

| Technologia      | Rola                                                  |
| ---------------- | ----------------------------------------------------- |
| PHP 5.3–5.4      | Logika aplikacji, rezerwacje, sprawdzanie dostępności |
| MySQL 5.5        | Baza danych                                           |
| Apache 2.2       | Serwer aplikacji                                      |
| HTML             | Struktura widoków                                     |
| CSS              | Wygląd aplikacji                                      |
| JavaScript (ES5) | Interakcje na stronie                                 |
| phpMyAdmin       | Zarządzanie bazą danych                               |

Pakiet instalacyjny: starsza wersja XAMPP przeznaczona dla Windows XP. Należy wybrać wydanie zgodne z XP, a nie współczesny XAMPP. Oficjalna strona projektu wskazuje, że dla XP potrzebne są starsze wydania, obsługujące PHP nie nowsze niż 5.4.&#x20;

[image](https://www.google.com/s2/favicons?domain=https://www.apachefriends.org\&sz=32)

apachefriends.org+1



Dlaczego ten wariant?

- Można wykorzystać istniejący model MySQL Workbench.
- Nie trzeba tworzyć osobnego programu instalowanego na każdym komputerze.
- Wystarczy przeglądarka.
- PHP dobrze nadaje się do prostych formularzy i operacji CRUD (dodawanie, odczyt, edycja, usuwanie).
- Można stopniowo rozwijać poszczególne widoki.

### Wariant B – Java + MySQL + Swing

Alternatywny

Aplikacja desktopowa Java Swing

Okna, formularze, tabele i przyciski

Java + JDBC

Logika programu i komunikacja z bazą

MySQL 5.5

Przechowywanie danych

| Technologia     | Rola                         |
| --------------- | ---------------------------- |
| Java 7          | Język programowania          |
| Java Swing      | Interfejs graficzny          |
| JDBC            | Połączenie z bazą danych     |
| MySQL 5.5       | Baza danych                  |
| NetBeans 8.x    | Środowisko programistyczne   |
| MySQL Workbench | Projektowanie i obsługa bazy |

Java 7 jest historycznie odpowiednim punktem wyjścia dla starszych systemów, ale Windows XP nie jest już oficjalnie obsługiwany przez Oracle. Korzystanie z niego wiąże się z ryzykiem.&#x20;

[image](https://www.google.com/s2/favicons?domain=https://www.java.com\&sz=32)

java.com+1



Zalety:

- Program działa jako samodzielna aplikacja okienkowa.
- Nie trzeba tworzyć stron internetowych.
- Można korzystać z istniejącego MySQL.

Wady:

- Więcej pracy przy tworzeniu interfejsu.
- Konieczność instalacji środowiska Java.
- Trudniejsze aktualizowanie programu na wielu komputerach.
- Większa ilość kodu potrzebna do uzyskania podobnej funkcjonalności.

## 3. Porównanie i wybór

| Kryterium                | PHP + MySQL  | Java + MySQL     |
| ------------------------ | ------------ | ---------------- |
| Prostota MVP             | Bardzo dobra | Średnia          |
| Interfejs                | Przeglądarka | Okna aplikacji   |
| Współdzielenie aplikacji | Łatwe        | Trudniejsze      |
| Wykorzystanie modelu MWB | Bezpośrednie | Bezpośrednie     |
| Formularze i tabele      | Łatwe        | Średnio łatwe    |
| Rozwój aplikacji         | Łatwy        | Średni           |
| Wymagania instalacyjne   | XAMPP        | Java, IDE, MySQL |

Mój wybór: wariant A – PHP + MySQL.

Uzasadnienie:

1. Projekt jest przede wszystkim systemem formularzy, tabel i rezerwacji.
2. Trzy zaplanowane widoki można łatwo wykonać jako strony internetowe.
3. Dwie osoby mogą pracować nad różnymi modułami.
4. Istniejący model bazy danych jest przygotowany dla MySQL.
5. Aplikacja może działać na jednym komputerze jako serwer i być otwierana z innych komputerów w sieci lokalnej.

Nie ma potrzeby wprowadzania Reacta, Node.js, Dockera czy innych rozbudowanych technologii.

Ważne zastrzeżenie: PHP 5.x i MySQL 5.5 są przestarzałe. Ten wariant traktowałbym jako rozwiązanie do prototypu i testów na odizolowanym środowisku, a nie system do przechowywania prawdziwych danych pacjentów. Windows XP zakończył wsparcie Microsoftu w 2014 roku.&#x20;

[image](https://www.google.com/s2/favicons?domain=https://www.java.com\&sz=32)

java.com+1



## 4. Lista potrzebnych narzędzi

Poniżej lista narzędzi potrzebnych do rozpoczęcia pracy.

| Narzędzie                     | Zastosowanie                          | Priorytet  |
| ----------------------------- | ------------------------------------- | ---------- |
| XAMPP dla Windows XP          | Apache, PHP, MySQL                    | Konieczne  |
| MySQL Workbench               | Projektowanie bazy i otwieranie MWB   | Konieczne  |
| Notepad++                     | Edycja plików PHP, HTML, CSS          | Konieczne  |
| Firefox w wersji zgodnej z XP | Testowanie aplikacji                  | Konieczne  |
| Git                           | Kontrola wersji i współpraca          | Zalecane   |
| TortoiseGit                   | Obsługa Git przez interfejs graficzny | Opcjonalne |
| diagrams.net                  | Diagramy i dokumentacja               | Zalecane   |
| LibreOffice                   | Dokumentacja projektu                 | Opcjonalne |

Ważne: narzędzia muszą mieć wydania zgodne z Windows XP. Nie należy automatycznie instalować najnowszych wersji.

## 5. Proponowana architektura aplikacji

Proponuję zastosować prosty podział na trzy warstwy:

1. Frontend – interfejs użytkownika.
2. Backend – logika aplikacji.
3. Database – przechowywanie danych.

Przykładowa struktura projektu:

```
caduceus/
│
├── index.php
│
├── config/
│   └── database.php
│
├── modules/
│   ├── terminy/
│   │   ├── lista.php
│   │   └── rezerwacja.php
│   │
│   ├── pacjenci/
│   │   └── formularz.php
│   │
│   └── wyposazenie/
│       ├── lista.php
│       └── edycja.php
│
├── includes/
│   ├── header.php
│   ├── menu.php
│   └── footer.php
│
├── css/
│   └── style.css
│
└── js/
    └── scripts.js
```

Nie proponuję na początku stosowania skomplikowanych frameworków. Zwykły PHP wystarczy do wykonania MVP.

## 6. Plan realizacji projektu

Proponuję podzielić pracę na sześć etapów.

1. Etap 1 – Przygotowanie środowiska

   - Instalacja XAMPP.
   - Uruchomienie Apache i MySQL.
   - Sprawdzenie połączenia z bazą.
   - Otwarcie pliku MWB.
   - Utworzenie repozytorium Git.

   Pierwszy kamień milowy

   &#x20;Działające środowisko lokalne.

2. Etap 2 – Przygotowanie bazy danych

   - Analiza obecnych tabel.
   - Ustalenie relacji.
   - Dodanie tabeli pomieszczeń.
   - Zaprojektowanie dostępności terminów.
   - Ustalenie sposobu przypisywania lekarzy i pomieszczeń.
   - Utworzenie bazy MySQL.

   Drugi kamień milowy

   &#x20;Gotowa baza danych MVP.

3. Etap 3 – Podstawowy interfejs

   - Menu główne.
   - Widok W01 – lista terminów.
   - Widok W02 – rezerwacja.
   - Widok W03 – wyposażenie.

   Trzeci kamień milowy

   &#x20;Wszystkie trzy widoki są dostępne.

4. Etap 4 – Implementacja funkcjonalności

   - F01 – zarządzanie wyposażeniem.
   - F02 – rezerwowanie wizyt.
   - F03 – wyświetlanie dostępnych terminów.
   - F04 – sprawdzanie dostępności pomieszczeń.
   - F05 – zmiana planu dnia.

   Czwarty kamień milowy

   &#x20;Działające funkcje MVP.

5. Etap 5 – Testowanie

   - Sprawdzanie konfliktów terminów.
   - Sprawdzanie konfliktów pomieszczeń.
   - Testowanie zmiany rezerwacji.
   - Testowanie dodawania i edycji wyposażenia.
   - Testowanie dwóch użytkowników jednocześnie.

   Piąty kamień milowy

   &#x20;Przetestowany MVP.

6. Etap 6 – Dokumentacja i przygotowanie v1

   - Instrukcja instalacji.
   - Instrukcja użytkownika.
   - Dokumentacja bazy danych.
   - Opis funkcjonalności.
   - Lista znanych ograniczeń.

   Ostatni kamień milowy

   &#x20;Gotowy prototyp Caduceus v1.



## 7. Podział pracy na dwie osoby

Proponuję podział według warstw aplikacji, aby ograniczyć konflikty w kodzie.

| Obszar            | Osoba 1                 | Osoba 2                 |
| ----------------- | ----------------------- | ----------------------- |
| Baza danych       | Główna odpowiedzialność | Konsultacja             |
| PHP               | Backend i logika        | Pomoc                   |
| HTML/CSS          | Konsultacja             | Główna odpowiedzialność |
| W01 – Terminy     | Backend                 | Interfejs               |
| W02 – Rezerwacja  | Backend                 | Interfejs               |
| W03 – Wyposażenie | Backend                 | Interfejs               |
| Testowanie        | Wspólnie                | Wspólnie                |
| Dokumentacja      | Wspólnie                | Wspólnie                |

Ważne, aby wcześniej uzgodnić nazwy tabel, kolumn i sposób komunikacji między PHP a bazą.

## 8. Najważniejsze kwestie do ustalenia przed programowaniem

W przesłanym modelu danych brakuje pomieszczeń i szczegółowego mechanizmu dostępności. Proponuję ustalić następujące zasady:

1. Czy jedna wizyta ma przypisanego dokładnie jednego lekarza?
2. Czy pomieszczenie jest rezerwowane na cały czas trwania wizyty?
3. Czy lekarz może mieć kilka wizyt jednocześnie? (Domyślnie nie).
4. Czy zmiana planu dnia oznacza edycję istniejącej wizyty, czy także jej anulowanie i przeniesienie?
5. Czy wyposażenie jest przypisywane do pomieszczeń?

Te decyzje wpłyną na projekt bazy danych.

## 9. Podsumowanie rekomendacji

# Caduceus v1

Rekomendowany stos technologiczny

PHP + MySQL + Apache + HTML/CSS/JavaScript

- Lokalna aplikacja internetowa.
- Bezpłatne narzędzia.
- Trzy widoki.
- Pięć funkcjonalności MVP.
- Wspólna baza danych.
- Kontrola wersji Git.

  Kolejność prac:

Środowisko → Baza danych → Interfejs → Funkcje → Testy → Dokumentacja.

## 10. Proponowany następny krok

Zanim zaczniemy pisać kod, proponuję wykonać dokładniejszą analizę pliku `BAZA_DANYCH_PSI.mwb` i przygotować docelowy model bazy danych dla Caduceus v1.

To pozwoli uniknąć sytuacji, w której napiszecie rezerwację wizyt, a później okaże się, że struktura bazy nie obsługuje konfliktów lekarzy, pomieszczeń i godzin.

Moja rekomendacja: najpierw dopracujmy bazę danych, potem uruchomimy środowisko PHP i rozpoczniemy implementację.
