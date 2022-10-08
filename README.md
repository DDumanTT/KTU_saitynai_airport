# T120B165 Saityno taikomųjų programų projektavimas

## Sistemos paskirtis

Projekto tikslas – palengvinti skrydžių paiešką.

Veikimo principas – pačią kuriamą platformą sudaro dvi dalys: internetinė aplikacija, kuria naudosis lankytojai, administratorius, bei aplikacijų programavimo sąsaja (angl. trump. API).

Svečias galės ieškoti skrydžių ir jei norės užsakyti, tada galės prisiregistruoti.

---

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

---

## Sistemos architektūra

Sistemos sudedamosios dalys:

- Kliento pusė (angl. Front-End) – naudojant Vue;
- Serverio pusė (angl. Back-End) – naudojant Laravel. Duomenų bazė – PostgreSQL.

1 pav. pavaizduota kuriamos sistemos diegimo diagrama. Sistemos talpinimui yra naudojamas Azure serveris. Kiekviena sistemos dalis yra diegiama tame pačiame serveryje. Internetinė aplikacija yra pasiekiama per HTTP protokolą.

![deployment diagram](deployment_diagram.png)

---

## API Specifikacija

WIP
