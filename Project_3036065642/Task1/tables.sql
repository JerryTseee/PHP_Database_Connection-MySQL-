CREATE TABLE dbprj_events(
    event_id INT NOT NULL,
    name VARCHAR(200) NOT NULL,
    address VARCHAR(200) NOT NULL,
    schedule DATETIME NOT NULL,
    PRIMARY KEY(event_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE dbprj_concerts(
    event_id INT NOT NULL,
    conductor VARCHAR(200) NOT NULL,
    PRIMARY KEY(event_id),
    FOREIGN KEY(event_id) REFERENCES dbprj_events(event_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE dbprj_dramas(
    event_id INT NOT NULL,
    director VARCHAR(200) NOT NULL,
    PRIMARY KEY(event_id),
    FOREIGN KEY(event_id) REFERENCES dbprj_events(event_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE dbprj_instruments(
    event_id INT NOT NULL,
    instrument VARCHAR(200) NOT NULL,
    PRIMARY KEY(event_id, instrument),
    FOREIGN KEY(event_id) REFERENCES dbprj_concerts(event_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE dbprj_genres(
    event_id INT NOT NULL,
    genre VARCHAR(200) NOT NULL,
    PRIMARY KEY(event_id, genre),
    FOREIGN KEY(event_id) REFERENCES dbprj_dramas(event_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE dbprj_concerts_parts(
    event_id INT NOT NULL,
    part_id INT NOT NULL,
    pic VARCHAR(200) NOT NULL,
    PRIMARY KEY(event_id, part_id),
    FOREIGN KEY(event_id) REFERENCES dbprj_concerts(event_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE dbprj_artists(
    artist_id INT NOT NULL,
    name VARCHAR(200) NOT NULL,
    gender ENUM('male', 'female', 'other') NOT NULL,
    PRIMARY KEY(artist_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE dbprj_performs(
    artist_id INT NOT NULL,
    event_id INT NOT NULL,
    PRIMARY KEY(artist_id, event_id),
    FOREIGN KEY(artist_id) REFERENCES dbprj_artists(artist_id),
    FOREIGN KEY(event_id) REFERENCES dbprj_events(event_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
