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
-- Name: czkj; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE czkj (
    gid integer NOT NULL,
    "名称" character varying(60),
    geom geometry(MultiPolygon,4326)
);


ALTER TABLE czkj OWNER TO postgres;

--
-- Name: czkj_gid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE czkj_gid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE czkj_gid_seq OWNER TO postgres;

--
-- Name: czkj_gid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE czkj_gid_seq OWNED BY czkj.gid;


--
-- Name: gid; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY czkj ALTER COLUMN gid SET DEFAULT nextval('czkj_gid_seq'::regclass);


--
-- Data for Name: czkj; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY czkj (gid, "名称", geom) FROM stdin;
1	\N	0106000020E6100000010000000103000000010000000700000010D960F2AB6A5E40385E7DEC3305454050F8288DFD685E40509DCE00CD044540607E7D1CC4675E40F080003621054540C0B06433DA665E40B8350603FB0745401816F43FFC675E4070163E68A9094540D8E01259406A5E40C04B1F4F6507454010D960F2AB6A5E40385E7DEC33054540
\.


--
-- Name: czkj_gid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('czkj_gid_seq', 1, true);


--
-- Name: czkj_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY czkj
    ADD CONSTRAINT czkj_pkey PRIMARY KEY (gid);


--
-- Name: czkj_geom_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX czkj_geom_idx ON czkj USING gist (geom);


--
-- PostgreSQL database dump complete
--

