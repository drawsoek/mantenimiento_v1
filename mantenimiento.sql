-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 08-05-2013 a las 17:46:33
-- Versión del servidor: 5.0.51
-- Versión de PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de datos: `mantenimiento`
-- 

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `areas`
-- 

CREATE TABLE `areas` (
  `id_area` int(11) NOT NULL auto_increment,
  `nombre` varchar(120) NOT NULL,
  PRIMARY KEY  (`id_area`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `areas`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `ordenes_trabajo`
-- 

CREATE TABLE `ordenes_trabajo` (
  `id_orden` int(11) NOT NULL auto_increment,
  `id_usuario` int(11) NOT NULL,
  `tipo_mto` int(11) NOT NULL,
  `tipo_servicio` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `trabajo` text NOT NULL,
  `material` text NOT NULL,
  `verifico` int(11) NOT NULL,
  `verifico_fecha` datetime NOT NULL,
  `aprobo` int(11) NOT NULL,
  `aprobo_fecha` datetime NOT NULL,
  PRIMARY KEY  (`id_orden`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `ordenes_trabajo`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `servicios`
-- 

CREATE TABLE `servicios` (
  `id_servicio` int(11) NOT NULL auto_increment,
  `nombre` varchar(120) NOT NULL,
  PRIMARY KEY  (`id_servicio`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `servicios`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `solicitudes_mto`
-- 

CREATE TABLE `solicitudes_mto` (
  `id_solicitud` int(11) NOT NULL auto_increment,
  `id_usuario` int(11) NOT NULL,
  `id_area` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `descripcion` text NOT NULL,
  `id_status` int(11) NOT NULL,
  `depto` int(120) NOT NULL COMMENT '1=recursos materiales, 2=mantenimientoequipo, 3=cc',
  PRIMARY KEY  (`id_solicitud`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `solicitudes_mto`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `status`
-- 

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL auto_increment,
  `nombre` varchar(120) NOT NULL,
  PRIMARY KEY  (`id_status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `status`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `usuarios`
-- 

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL auto_increment,
  `nombre` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL,
  `id_area` int(11) NOT NULL,
  `firma` varchar(120) NOT NULL,
  PRIMARY KEY  (`id_usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `usuarios`
-- 

