Tytuł projektu: Caduceus

Cel v1: Program do rezerwacji terminów i pomieszczeń w przychodni


Główną grupą docelową są administratorzy lokalnych przychodni, mogą oni używać Caduceus, aby rejestrować pacjentów, i bezkonfliktowo ustalać daty wizyt, oraz na zarządzanie sprzętem.


| ID | Funkcjonalność | Zakres |
|-----|---------------|--------|
| F01 | System musi przechowywac dane o calym wyposazeniu przychodni | MVP |

| F02 | System musi umożliwić pracownikom rezerwacje wizyty | MVP |

| F03 | System powinien pokazywać dostępne terminy wizyt | MVP |

| F04 | System powinien pokazywać dostępne pomieszczenia we wskazanym terminie | MVP |

| F05 | Systen musi umożliwić zmianę planu w trakcie dnia | MVP |


| Widok | Potrzebne Dane | Funkcjonalność |
|-----|---------------|--------|
|W01 lista terminów | Terminy  | F03 |

|W02 Rezerwacja terminu | Terminy ,Pacjent, Lekarz | F02, F04 ,F05| 

|W03 Wyposażenie | wyposażenie | F01 |

Funkcja F06 powinna być dodanane w wersji v2 do widoku W03.
Dla funkcji F08 należy dodać nowy widok, dla danych pacjenta.
