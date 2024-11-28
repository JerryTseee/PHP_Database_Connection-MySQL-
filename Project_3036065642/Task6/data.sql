-- insert the events, there is one event that is neither a drama nor a concert
INSERT INTO dbprj_events (event_id, name, address, schedule) VALUES (1,'KidsFest - Bear In the Park','Drama Theatre, HKAPA','2024-09-02 10:00');
INSERT INTO dbprj_events (event_id, name, address, schedule) VALUES (7,'Romeo and Juliet','703 Mallory St','2024-09-13 21:30');
INSERT INTO dbprj_events (event_id, name, address, schedule) VALUES (13,'Brent Suarez Unmasked','HK City Hall Concert Hall','2024-11-11 17:00');
INSERT INTO dbprj_events (event_id, name, address, schedule) VALUES (22,'Brylee Robertson Live in Concert 2024','Star Hall, KITEC','2024-11-16 20:15');
INSERT INTO dbprj_events (event_id, name, address, schedule) VALUES (20,'Emmalee Heath Tour Hong Kong','Drama Theatre, HKAPA','2024-10-13 20:00');
INSERT INTO dbprj_events (event_id, name, address, schedule) VALUES (30,'Stephen Curry Night','Prince Edward 205','2024-10-30 20:00');

-- 2 records in dbprj_dramas, each drama is only one genre
INSERT INTO dbprj_dramas(event_id, director) VALUES(1, 'Elaine Haas');
INSERT INTO dbprj_dramas(event_id, director) VALUES(7, 'Houston Hunt');
INSERT INTO dbprj_genres (event_id, genre) VALUES (1,'Children');
INSERT INTO dbprj_genres (event_id, genre) VALUES (7,'Tragic');

-- 3 records in dbprj_concerts
INSERT INTO dbprj_concerts(event_id, conductor) VALUES(13,'Ali Delgado');
INSERT INTO dbprj_concerts(event_id, conductor) VALUES(22,'Zachery Nash');
INSERT INTO dbprj_concerts(event_id, conductor) VALUES(20,'Joaquin Olson');

-- 6 records in dbprj_concerts_parts
INSERT INTO dbprj_concerts_parts(event_id, part_id, pic) VALUES(13, 1, 'Maxwell Barrett');
INSERT INTO dbprj_concerts_parts(event_id, part_id, pic) VALUES(13, 2, 'Jaydin Zimmerman');
INSERT INTO dbprj_concerts_parts(event_id, part_id, pic) VALUES(22, 1, 'Jerry Tse');
INSERT INTO dbprj_concerts_parts(event_id, part_id, pic) VALUES(22, 2, 'Tony Poon');
INSERT INTO dbprj_concerts_parts(event_id, part_id, pic) VALUES(22, 3, 'Leo Ho');
INSERT INTO dbprj_concerts_parts(event_id, part_id, pic) VALUES(22, 4, 'Taku Komura');

-- each concert use at least one instrument, number should be different
INSERT INTO dbprj_instruments (event_id, instrument) VALUES (13,'Piano');
INSERT INTO dbprj_instruments (event_id, instrument) VALUES (22,'Drumset');
INSERT INTO dbprj_instruments (event_id, instrument) VALUES (22,'Keyboard');
INSERT INTO dbprj_instruments (event_id, instrument) VALUES (20,'Guitar');
INSERT INTO dbprj_instruments (event_id, instrument) VALUES (20,'Bass');
INSERT INTO dbprj_instruments (event_id, instrument) VALUES (20,'Piano');

-- 3 records in dbprj_artists
INSERT INTO dbprj_artists (artist_id, name, gender) VALUES (1,'Xie Hongbo','male');
INSERT INTO dbprj_artists (artist_id, name, gender) VALUES (2,'Guan Xinyi','female');
INSERT INTO dbprj_artists (artist_id, name, gender) VALUES (3,'Dai Jiahao','female');

-- 7 records in dbprj_performs
INSERT INTO dbprj_performs(artist_id, event_id) VALUES(1,1);
INSERT INTO dbprj_performs(artist_id, event_id) VALUES(1,7);
INSERT INTO dbprj_performs(artist_id, event_id) VALUES(1,13);
INSERT INTO dbprj_performs(artist_id, event_id) VALUES(2,22);
INSERT INTO dbprj_performs(artist_id, event_id) VALUES(2,20);
INSERT INTO dbprj_performs(artist_id, event_id) VALUES(3,30);
INSERT INTO dbprj_performs(artist_id, event_id) VALUES(3,1);
