--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.5
-- Dumped by pg_dump version 9.5.5

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: stkj; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE stkj (
    gid integer NOT NULL,
    "名称" character varying(60),
    geom geometry(MultiPolygon,4326)
);


ALTER TABLE stkj OWNER TO postgres;

--
-- Name: stkj_gid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE stkj_gid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE stkj_gid_seq OWNER TO postgres;

--
-- Name: stkj_gid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE stkj_gid_seq OWNED BY stkj.gid;


--
-- Name: gid; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY stkj ALTER COLUMN gid SET DEFAULT nextval('stkj_gid_seq'::regclass);


--
-- Data for Name: stkj; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY stkj (gid, "名称", geom) FROM stdin;
1	\N	0106000020E61000000100000001030000000100000009000000D89ECB4374645E40603EEFFBA5FE44404841EE9DE6625E403051C20FD6FC444040A12A696E615E40C8713576E0FE444030ABC3A418615E40703614874401454070E4FAE41B625E4048B390B956034540A87ECD53CB625E4090FB670E0A0445409832C3FF97635E40F823B6E9750345403800DCE881645E40C83689FDA5014540D89ECB4374645E40603EEFFBA5FE4440
\.


--
-- Name: stkj_gid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('stkj_gid_seq', 1, true);


--
-- Name: stkj_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY stkj
    ADD CONSTRAINT stkj_pkey PRIMARY KEY (gid);


--
-- Name: stkj_geom_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX stkj_geom_idx ON stkj USING gist (geom);


--
-- PostgreSQL database dump complete
--

