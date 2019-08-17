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
-- Name: nykj; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE nykj (
    gid integer NOT NULL,
    "名称" character varying(60),
    geom geometry(MultiPolygon,4326)
);


ALTER TABLE nykj OWNER TO postgres;

--
-- Name: nykj_gid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE nykj_gid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE nykj_gid_seq OWNER TO postgres;

--
-- Name: nykj_gid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE nykj_gid_seq OWNED BY nykj.gid;


--
-- Name: gid; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY nykj ALTER COLUMN gid SET DEFAULT nextval('nykj_gid_seq'::regclass);


--
-- Data for Name: nykj; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY nykj (gid, "名称", geom) FROM stdin;
1	\N	0106000020E61000000100000001030000000100000005000000B83ABA25CB705E40606BDD3E85F84440A8E0972ED9705E40D001D2A4D1F24440F8520C63E56B5E4038F9E334E0F644400855CA292E6E5E4030AF6BBFA5FF4440B83ABA25CB705E40606BDD3E85F84440
\.


--
-- Name: nykj_gid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('nykj_gid_seq', 1, true);


--
-- Name: nykj_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY nykj
    ADD CONSTRAINT nykj_pkey PRIMARY KEY (gid);


--
-- Name: nykj_geom_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX nykj_geom_idx ON nykj USING gist (geom);


--
-- PostgreSQL database dump complete
--

