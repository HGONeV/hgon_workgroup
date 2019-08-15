#
# Table structure for table 'tx_hgonworkgroup_domain_model_workgroup'
#
CREATE TABLE tx_hgonworkgroup_domain_model_workgroup (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	title varchar(255) DEFAULT '' NOT NULL,
	description text,
	short_description varchar(255) DEFAULT '' NOT NULL,
	address varchar(255) DEFAULT '' NOT NULL,
	zip varchar(255) DEFAULT '' NOT NULL,
	city varchar(255) DEFAULT '' NOT NULL,
	district varchar(255) DEFAULT '' NOT NULL,

	contact_person int(11) unsigned DEFAULT '0' NOT NULL,
	wg_event int(11) unsigned DEFAULT '0' NOT NULL,
	std_event int(11) unsigned DEFAULT '0' NOT NULL,
	tx_news int(11) DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted smallint(5) unsigned DEFAULT '0' NOT NULL,
	hidden smallint(5) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state smallint(6) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,
	l10n_state text,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
	KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_rkwauthors_domain_model_authors'
#
CREATE TABLE tx_rkwauthors_domain_model_authors (

	workgroup int(11) unsigned DEFAULT '0' NOT NULL,

);

#
# Table structure for table 'tx_rkwevents_domain_model_event'
#
CREATE TABLE tx_rkwevents_domain_model_event (
    tx_hgon_workgroup_stdevent int(11) unsigned DEFAULT '0' NOT NULL,
	tx_hgon_workgroup_wgevent int(11) unsigned DEFAULT '0' NOT NULL,
);


#
# Table structure for table 'tx_news_domain_model_news'
#
CREATE TABLE tx_news_domain_model_news (
    tx_hgon_workgroup varchar(250) DEFAULT '' NOT NULL
);


#
# Table structure for table 'tx_hgonworkgroup_domain_model_workgroup_news_mm'
#
CREATE TABLE tx_hgonworkgroup_domain_model_workgroup_news_mm (
	uid_local int(11) DEFAULT '0' NOT NULL,
	uid_foreign int(11) DEFAULT '0' NOT NULL,
	sorting int(11) DEFAULT '0' NOT NULL,
	sorting_foreign int(11) DEFAULT '0' NOT NULL,
	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);