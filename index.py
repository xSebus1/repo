import sqlite3
from datetime import datetime

conn = sqlite3.connect('SQlite')
cursor = conn.cursor()
cursor.execute('''
    CREATE TABLE IF NOT EXISTS rezerwacje(
        id int PRIMARY KEY,
        data DATE NOT NULL,
        na_jakie_wydarzenie varchar(25) NOT NULL,
        imie_wypozyczającego varchar(50) NOT NULL,
        nazwisko_wypozyczającego varchar(50) NOT NULL
    )
''')

zajete = [1]
current = zajete[-1]

def isTimeFormat(date, format="%Y-%m-%d"):
    if not isinstance(date, str):
        return False
    try:
        datetime.strptime(date, format)
        return True
    except ValueError:
        return False 

print(isTimeFormat("2026-11-25"))  

def reserveSpace(date, wydarzenie, imie_wypozyczajacego, nazwisko_wypozyczajacego):
    if isTimeFormat(date) == False:
        print("Nie poprawny format daty")
        return False

    try:
        cursor.execute('''INSERT INTO rezerwacje (data, na_jakie_wydarzenie, imie_wypozyczającego, nazwisko_wypozyczającego) VALUES (?, ?, ?, ?)''', (date, wydarzenie, imie_wypozyczajacego, nazwisko_wypozyczajacego))
        list.append(current + 1)
    except sqlite3.Error as e:
        print(f" Bład przy operacji: {e}")
    finally:
        if conn:
            conn.close

def removeReservedSpace(id):
    try:
        row = cursor.execute('''
        DELETE FROM rezerwacje WHERE ID = ?''', id)
    except sqlite3.Error as e:
        print(f" Bład przy operacji: {e}")
    finally:
        if conn:
            conn.close

def showReservedSpace(id):
    try:
        cursor.execute('''
        SELECT * FROM rezerwacje
    ''')
        row = cursor.fetchall()

        for line in row:
            print(line)

        if id in zajete:
            print("Te miesjce jest zajete! ")
    except sqlite3.Error as e:
        print(f" Bład przy operacji: {e}")
    finally:
        if conn:
            conn.close

def updateReservedSpace(action, arg, id):
    conn = sqlite3.connect('SQlite')
    cursor = conn.cursor()

    if action == "data" or "date":
        try:
            cursor.execute('''
            UPDATE rezerwacje (
                SET date = ? WHERE id = ?
            )''', (arg, id))
        except sqlite3.Error as e:
            print(f" Bład przy operacji: {e}")
        finally:
            if conn:
                conn.close

    if action == "wydarzenie" or "event":
        try:
            cursor.execute('''
            UPDATE rezerwacje (
                SET na_jakie_wydarzenie = ? WHERE id = ?
            )''', (arg, id))
        except sqlite3.Error as e:
            print(f" Bład przy operacji: {e}")
        finally:
            if conn:
                conn.close

    if action == "imie" or "imie_rezerwujacego" or "name":
        try:
            cursor.execute('''
            UPDATE rezerwacje (
                SET imie_wypozycząjącego = ? WHERE id = ?
            )''', (arg, id))
        except sqlite3.Error as e:
            print(f" Bład przy operacji: {e}")
        finally:
            if conn:
                conn.close

    if action == "nazwisko_wypozyczającego" or "surname_wypozyczającego":
        try:
            cursor.execute('''
            UPDATE rezerwacje (
                SET nazwisko_wypozyczającego = ? WHERE id = ?
            )''', (arg, id))
        except sqlite3.Error as e:
            print(f" Bład przy operacji: {e}")
        finally:
            if conn:
                conn.close
                
while True:
    akcja = int(input("Wprowadz akcje (1 - Dodaj | 2 - Usuń | 3 - Aktualizacja | 4 - Pokaz po id): "))
    if akcja == 1:
        data = str(input("Wprowadz date (FORMAT: YYYY-MM-DD): "))
        wydarzenie = input("Wprowadz na jakie wydarzenie: ")
        imie = input("Wprowadz imie wypozyczajacego: ")
        nazwisko = input("Wprowadz nazwisko wypozyczajacego: ")
        
        reserveSpace(data, wydarzenie, imie, nazwisko)
        showReservedSpace(1)
        break     
            
    if akcja == 2:
        id = int(input("Wprowadz id: "))
        removeReservedSpace(id)
        break
        
    if akcja == 3:
        action = input("Wprowadz co zmienic (typ kolumny): ")
        arg = input("Wprowadz na co chcesz zmienić (value): ")
        id = int(input("Wprowadz id: "))
        updateReservedSpace(action, arg, id)
        break
        
    if akcja == 4:
        id = int(input("Wprowadz id: "))
        showReservedSpace(id)
        break
