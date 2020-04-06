create table player_data
(
    player_id      int auto_increment
        primary key,
    name           varchar(50)   not null,
    winnings_total int default 0 not null,
    constraint player_data_name_uindex
        unique (name)
);

create table session_game
(
    session_id int auto_increment,
    host_name  varchar(50) not null,
    constraint session_game_session_id_uindex
        unique (session_id)
);

alter table session_game
    add primary key (session_id);

create table game_settings
(
    settings_id int auto_increment
        primary key,
    B_blind     float not null,
    S_blind     float not null,
    fiches      float not null,
    tijd        int   not null,
    pot         int   not null,
    settings_fk int   null,
    constraint game_settings_session_game_session_id_fk
        foreign key (settings_fk) references session_game (session_id)
);

create table player_game
(
    player_game_id   int auto_increment
        primary key,
    rebuy            tinyint(1) default 0 null,
    game_id          int                  null,
    winnings_current int        default 0 null,
    seat             int        default 0 null,
    is_host          tinyint(1) default 0 not null,
    tafel            int        default 0 null,
    player_id_fk     int                  not null,
    constraint player_game_player_data_player_id_fk
        foreign key (player_id_fk) references player_data (player_id)
            on update cascade,
    constraint player_game_session_game_session_id_fk
        foreign key (game_id) references session_game (session_id)
);