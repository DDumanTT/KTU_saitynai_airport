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

# Naudotojo sąsaja

## Langų "wireframes"

Prisijungimo langas:

![image](https://user-images.githubusercontent.com/68790146/208309244-b27c1614-dcc1-4e0a-9eb2-ad853f9a2f65.png)

Registracijos langas:

![image](https://user-images.githubusercontent.com/68790146/208309248-a605fc93-9c63-40a3-bd0e-56dacf4a0e84.png)

Pagrindinis langas:

![image](https://user-images.githubusercontent.com/68790146/208309261-df3f5ea8-3714-465f-bf73-9856f7ba5465.png)

CRUD langas:

![image](https://user-images.githubusercontent.com/68790146/208309268-67be47e8-11af-4505-b268-a1666acae967.png)

## Langai

Prisijungimo langas:

![image](https://user-images.githubusercontent.com/68790146/208309309-ac62b587-b265-4f9e-9d21-ecad2f4bfe2b.png)

Registracijos langas:

![image](https://user-images.githubusercontent.com/68790146/208309315-709d5294-29ba-4692-92cc-e3104454d2c3.png)

Pagrindinis langas:

![image](https://user-images.githubusercontent.com/68790146/208309284-75cfb395-16f9-4a11-a2de-7d1c34ec684d.png)

CRUD langas:

![image](https://user-images.githubusercontent.com/68790146/208309303-c5cc8c09-fea7-43a2-8347-c6d04a5e99c6.png)

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

---

## City

HTTP metodas: GET

Paskirtis: Gauti visus miestus

URI: `/api/cities/`

Užklausos struktūra: -

Užklausos _header_: -

Užklausos atsakymas:

```json
[
  {
    "id": 10,
    "country": "Hong Kong",
    "name": "Lavinahaven",
    "created_at": "2022-12-18T16:04:40.000000Z",
    "updated_at": "2022-12-18T16:04:40.000000Z"
  },
...
]
```

Atsakymo kodas: 200 (OK)

Klaidų kodai:

- 404 - Nerasta miestų

---

HTTP metodas: GET

Paskirtis: Gauti miestą pagal ID

URI: `/api/cities/{id}`

Užklausos struktūra: -

Užklausos _header_: -

Užklausos atsakymas:

```json
[
  {
    "id": 10,
    "country": "Hong Kong",
    "name": "Lavinahaven",
    "created_at": "2022-12-18T16:04:40.000000Z",
    "updated_at": "2022-12-18T16:04:40.000000Z"
  }
...
]
```

Atsakymo kodas: 200 (OK)

Klaidų kodai:

- 404 - Nerastas miestas

---

HTTP metodas: POST

Paskirtis: Sukurt naują miestą

URI: `/api/cities/`

Užklausos struktūra:

```json
{
  "country": "test",
  "name": "test"
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
[
  {
    "id": 11,
    "country": "test",
    "name": "test",
    "created_at": "2022-12-18T16:04:40.000000Z",
    "updated_at": "2022-12-18T16:04:40.000000Z"
  }
...
]
```

Atsakymo kodas: 201 (Created)

Klaidų kodai:

- 422 - Bloga užklausa

---

HTTP metodas: PUT

Paskirtis: Atnaujinti miestą

URI: `/api/cities/{id}`

Užklausos struktūra:

```json
{
  "country": "test1",
  "name": "test1"
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
[
  {
    "id": 11,
    "country": "test1",
    "name": "test1",
    "created_at": "2022-12-18T16:04:40.000000Z",
    "updated_at": "2022-12-18T16:05:40.000000Z"
  }
...
]
```

Atsakymo kodas: 200 (OK)

Klaidų kodai:

- 404 - Nerastas miestas
- 422 - Bloga užklausa

---

HTTP metodas: DELETE

Paskirtis: Ištrinti miestą

URI: `/api/cities/{id}`

Užklausos struktūra: -

Užklausos _header_: -

Užklausos atsakymas: -

Atsakymo kodas: 200 (OK)

Klaidų kodai:

- 404 - Nerastas miestas

---

# Išvados

- Sukurtas projektas pasinaudojant saitynų technologijas;
- Sukurta projekto serverio pusė;
- Sukurta duomenų bazė ir susieta su serveriu;
- Sukurta naudotojo sąsaja, kuri naudoja serverį.
