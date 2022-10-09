# T120B165 Saityno taikomųjų programų projektavimas

## Sistemos paskirtis

Projekto tikslas – palengvinti skrydžių paiešką.

Veikimo principas – pačią kuriamą platformą sudaro dvi dalys: internetinė aplikacija, kuria naudosis lankytojai, administratorius, bei aplikacijų programavimo sąsaja (angl. trump. API).

Svečias galės ieškoti skrydžių ir jei norės užsakyti, tada galės prisiregistruoti.

## Funkciniai reikalavimai

Svečias galės:

1. Peržiūrėti pagrindinį puslapį;
2. Ieškoti skrydžių;
3. Prisijungti ir prisiregistruoti prie internetinės aplikacijos.

Registruotas sistemos naudotojas galės:

1. Atsijungti nuo internetinės aplikacijos;
2. Ieškoti skrydžių;
3. Užsakyti skrydį;
4. Atšaukti skrydį;

Administratorius galės:

1. Patvirtinti naudotojo registraciją;
2. Pridėti naujus skrydžius;
3. Pridėti naujus lėktuvus;
4. Šalinti naudotojus;
5. Pridėti administratorius.

## Sistemos architektūra

Sistemos sudedamosios dalys:

- Kliento pusė (angl. Front-End) – naudojant Vue;
- Serverio pusė (angl. Back-End) – naudojant Laravel. Duomenų bazė – PostgreSQL.

1 pav. pavaizduota kuriamos sistemos diegimo diagrama. Sistemos talpinimui yra naudojamas Azure serveris. Kiekviena sistemos dalis yra diegiama tame pačiame serveryje. Internetinė aplikacija yra pasiekiama per HTTP protokolą.

![deployment diagram](deployment_diagram.png)

# API Specifikacija

## Airport

HTTP metodas: GET

Paskirtis: Gauti visus oro uostus

URI: `/api/airports/`

Užklausos struktūra: -

Užklausos _header_: -

Užklausos atsakymas:

```json
[
  {
    "id": 1,
    "name": "Block LLC",
    "address": "603 Mable Keys\nDareberg, CT 77469",
    "code": "ODTU\/AKA",
    "created_at": "2022-10-08T17:39:02.000000Z",
    "updated_at": "2022-10-08T17:39:02.000000Z"
  },
  ...
]
```

Atsakymo kodas: 200 (OK)

Klaidų kodai:

- 404 - Nerasta oro uostų

---

HTTP metodas: GET

Paskirtis: Gauti oro uostą pagal ID

URI: `/api/airports/{id}`

Užklausos struktūra: -

Užklausos _header_: -

Užklausos atsakymas:

```json
{
  "id": 1,
  "name": "Block LLC",
  "address": "603 Mable Keys\nDareberg, CT 77469",
  "code": "ODTU/AKA",
  "created_at": "2022-10-08T17:39:02.000000Z",
  "updated_at": "2022-10-08T17:39:02.000000Z"
}
```

Atsakymo kodas: 200 (OK)

Klaidų kodai:

- 404 - Nerastas oro uostas

---

HTTP metodas: POST

Paskirtis: Sukurt naują oro uostą

URI: `/api/airports/`

Užklausos struktūra:

```json
{
  "name": "test_name",
  "address": "test_address",
  "code": "test_code"
}
```

Užklausos _header_:

```json
{
  "X-Requested-With": "XMLHttpRequest"
}
```

Užklausos atsakymas:

```json
{
  "name": "test_name",
  "address": "test_address",
  "code": "test_code",
  "updated_at": "2022-10-09T20:40:47.000000Z",
  "created_at": "2022-10-09T20:40:47.000000Z",
  "id": 12
}
```

Atsakymo kodas: 201 (Created)

Klaidų kodai:

- 422 - Bloga užklausa

---

HTTP metodas: PUT

Paskirtis: Atnaujinti oro uostą

URI: `/api/airports/{id}`

Užklausos struktūra:

```json
{
  "name": "test_name_updated",
  "address": "test_address_updated",
  "code": "test_code_updated"
}
```

Užklausos _header_:

```json
{
  "X-Requested-With": "XMLHttpRequest"
}
```

Užklausos atsakymas:

```json
{
  "id": 8,
  "name": "test_name_updated",
  "address": "test_address_updated",
  "code": "test_code_updated",
  "created_at": "2022-10-08T17:45:09.000000Z",
  "updated_at": "2022-10-08T18:00:01.000000Z"
}
```

Klaidų kodai:

- 404 - Nerastas oro uostas
- 422 - Bloga užklausa

---

HTTP metodas: DELETE

Paskirtis: Ištrinti oro uostą

URI: `/api/airports/{id}`

Užklausos struktūra: -

Užklausos _header_: -

Užklausos atsakymas: -

Atsakymo kodas: 200 (OK)

Klaidų kodai:

- 404 - Nerastas oro uostas

---

## Flight

HTTP metodas: GET
Paskirtis: Gauti visus skrydžius
URI: `/api/flights/`
Užklausos struktūra: -
Užklausos _header_: -
Užklausos atsakymas:

```json
[
  {
    "id": 1,
    "code": "rb9156",
    "gate": "w6",
    "duration": "11:53:31",
    "departure_time": "2014-07-05 19:20:22",
    "arrival_time": "2019-07-01 07:12:10",
    "price": "153.43",
    "departure_id": 4,
    "arrival_id": 5,
    "created_at": "2022-10-08T17:39:02.000000Z",
    "updated_at": "2022-10-08T17:39:02.000000Z"
  },
...
]
```

Atsakymo kodas: 200 (OK)

Klaidų kodai:

- 404 - Nerasta skrydžių

---

HTTP metodas: GET

Paskirtis: Gauti skrydį pagal ID

URI: `/api/flights/{id}`

Užklausos struktūra: -

Užklausos _header_: -

Užklausos atsakymas:

```json
{
  "id": 8,
  "code": "jp0407",
  "gate": "c8",
  "duration": "03:39:45",
  "departure_time": "2006-05-25 01:07:49",
  "arrival_time": "1998-09-08 03:40:20",
  "price": "723.91",
  "departure_id": 3,
  "arrival_id": 1,
  "created_at": "2022-10-08T17:39:02.000000Z",
  "updated_at": "2022-10-08T17:39:02.000000Z"
}
```

Atsakymo kodas: 200 (OK)

Klaidų kodai:

- 404 - Nerastas skrydis

---

HTTP metodas: POST

Paskirtis: Sukurt naują skrydį

URI: `/api/flights/`

Užklausos struktūra:

```json
{
  "code": "test_code",
  "gate": "test_gate",
  "duration": "08:25:01",
  "departure_time": "2022-10-08 12:12:12",
  "arrival_time": "2022-10-09 12:12:12",
  "departure_id": "1",
  "arrival_id": "2",
  "price": "10.5"
}
```

Užklausos _header_:

```json
{
  "X-Requested-With": "XMLHttpRequest"
}
```

Užklausos atsakymas:

```json
{
  "code": "test_code",
  "gate": "test_gate",
  "duration": "08:25:01",
  "departure_time": "2022-10-08 12:12:12",
  "arrival_time": "2022-10-09 12:12:12",
  "departure_id": "1",
  "arrival_id": "2",
  "price": "10.5",
  "updated_at": "2022-10-08T18:58:52.000000Z",
  "created_at": "2022-10-08T18:58:52.000000Z",
  "id": 18
}
```

Atsakymo kodas: 201 (Created)

Klaidų kodai:

- 422 - Bloga užklausa

---

HTTP metodas: PUT

Paskirtis: Atnaujinti skrydį

URI: `/api/flights/{id}`

Užklausos struktūra:

```json
{
  "code": "test_code",
  "gate": "test_gate",
  "duration": "08:25:01",
  "departure_time": "2022-10-08 12:12:12",
  "arrival_time": "2022-10-09 12:12:12",
  "price": "10.5",
  "departure_id": "4",
  "arrival_id": "3"
}
```

Užklausos _header_:

```json
{
  "X-Requested-With": "XMLHttpRequest"
}
```

Užklausos atsakymas:

```json
{
  "id": 15,
  "code": "test_code",
  "gate": "test_gate",
  "duration": "08:25:01",
  "departure_time": "2022-10-08 12:12:12",
  "arrival_time": "2022-10-09 12:12:12",
  "price": "10.5",
  "departure_id": "4",
  "arrival_id": "3",
  "created_at": "2022-10-08T18:37:14.000000Z",
  "updated_at": "2022-10-08T18:59:45.000000Z"
}
```

Atsakymo kodas: 200 (OK)

Klaidų kodai:

- 404 - Nerastas skrydis
- 422 - Bloga užklausa

---

HTTP metodas: DELETE

Paskirtis: Ištrinti skrydį

URI: `/api/fligths/{id}`

Užklausos struktūra: -

Užklausos _header_: -

Užklausos atsakymas: -

Atsakymo kodas: 200 (OK)

Klaidų kodai:

- 404 - Nerastas skrydis

---

## Plane

HTTP metodas: GET

Paskirtis: Gauti visus lėktuvus

URI: `/api/planes/`

Užklausos struktūra: -

Užklausos _header_: -

Užklausos atsakymas:

```json
[
  {
    "id": 2,
    "model": "qxiqw",
    "seats": "484",
    "flight_id": 2,
    "created_at": "2022-10-08T17:39:02.000000Z",
    "updated_at": "2022-10-08T17:39:02.000000Z"
  },
...
]
```

Atsakymo kodas: 200 (OK)

Klaidų kodai:

- 404 - Nerasta lėktuvų

---

HTTP metodas: GET

Paskirtis: Gauti lėktuvą pagal ID

URI: `/api/planes/{id}`

Užklausos struktūra: -

Užklausos _header_: -

Užklausos atsakymas:

```json
{
  "id": 8,
  "model": "kbmnm",
  "seats": "932",
  "flight_id": 8,
  "created_at": "2022-10-08T17:39:02.000000Z",
  "updated_at": "2022-10-08T17:39:02.000000Z"
}
```

Atsakymo kodas: 200 (OK)

Klaidų kodai:

- 404 - Nerastas lėktuvas

---

HTTP metodas: POST

Paskirtis: Sukurt naują lėktuvą

URI: `/api/planes/`

Užklausos struktūra:

```json
{
  "model": "test",
  "seats": "50",
  "flight_id": "5"
}
```

Užklausos _header_:

```json
{
  "X-Requested-With": "XMLHttpRequest"
}
```

Užklausos atsakymas:

```json
{
  "model": "test",
  "seats": "50",
  "flight_id": "5",
  "updated_at": "2022-10-08T19:28:43.000000Z",
  "created_at": "2022-10-08T19:28:43.000000Z",
  "id": 11
}
```

Atsakymo kodas: 201 (Created)

Klaidų kodai:

- 422 - Bloga užklausa

---

HTTP metodas: PUT

Paskirtis: Atnaujinti lėktuvą

URI: `/api/planes/{id}`

Užklausos struktūra:

```json
{
  "model": "test",
  "seats": "50",
  "flight_id": "5"
}
```

Užklausos _header_:

```json
{
  "X-Requested-With": "XMLHttpRequest"
}
```

Užklausos atsakymas:

```json
{
  "id": 1,
  "model": "test",
  "seats": "50",
  "flight_id": "5",
  "created_at": "2022-10-08T17:39:02.000000Z",
  "updated_at": "2022-10-08T19:29:17.000000Z"
}
```

Atsakymo kodas: 200 (OK)

Klaidų kodai:

- 404 - Nerastas lėktuvas
- 422 - Bloga užklausa

---

HTTP metodas: DELETE

Paskirtis: Ištrinti lėktuvą

URI: `/api/planes/{id}`

Užklausos struktūra: -

Užklausos _header_: -

Užklausos atsakymas: -

Atsakymo kodas: 200 (OK)

Klaidų kodai:

- 404 - Nerastas lėktuvas
