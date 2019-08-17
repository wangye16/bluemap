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
-- Name: kfbj; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE kfbj (
    gid integer NOT NULL,
    objectid_1 numeric(10,0),
    objectid numeric(10,0),
    bsm numeric(10,0),
    xzqdm character varying(12),
    xzqmc character varying(100),
    gkyq character varying(254),
    ydmj double precision,
    sm character varying(254),
    shape_leng numeric,
    shape_le_1 numeric,
    shape_area numeric,
    geom geometry(MultiPolygon,4326)
);


ALTER TABLE kfbj OWNER TO postgres;

--
-- Name: kfbj_gid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE kfbj_gid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE kfbj_gid_seq OWNER TO postgres;

--
-- Name: kfbj_gid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE kfbj_gid_seq OWNED BY kfbj.gid;


--
-- Name: gid; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY kfbj ALTER COLUMN gid SET DEFAULT nextval('kfbj_gid_seq'::regclass);


--
-- Data for Name: kfbj; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY kfbj (gid, objectid_1, objectid, bsm, xzqdm, xzqmc, gkyq, ydmj, sm, shape_leng, shape_le_1, shape_area, geom) FROM stdin;
1	1	1	0	\N	\N	\N	34885400	\N	22785.9385238	0.189163800003	0.00217997824905	0106000020E61000000100000001030000000100000012000000F695D0FE29675E4022A0F021A3FF4440918BC8622F685E4014C746BDCA004540348AB29D28695E40A58285C29F01454039EC86970B6A5E402DEB199F1D024540739900FE426B5E408E0451CDFF0145402EE796C0876B5E4042AA594FB5014540D3D5A63E256C5E407FBE3721A4FF4440BF2C4A1C336C5E4021D63BDBD7FE4440730DC71A016C5E401DC6EA0573FE4440BF8773B3716B5E400F143ED0E8FD44400F20831B436A5E40238F40193AFD4440C76499B1DC685E4029C3E856A5FC4440D69B9BB812685E406A4488D759FC44403E9B3955DD675E40DAA7ED5384FC444009AE13C292675E405A8ED3AB4DFD4440CB4491B554675E40EA71CB1B2CFE4440EF951038FD665E4003618ADF21FF4440F695D0FE29675E4022A0F021A3FF4440
\.


--
-- Name: kfbj_gid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('kfbj_gid_seq', 1, true);


--
-- Name: kfbj_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY kfbj
    ADD CONSTRAINT kfbj_pkey PRIMARY KEY (gid);


--
-- Name: kfbj_geom_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX kfbj_geom_idx ON kfbj USING gist (geom);


--
-- PostgreSQL database dump complete
--

