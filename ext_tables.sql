#
# Table structure for table 'tx_pxamessagebox_domain_model_message'
#
CREATE TABLE tx_pxamessagebox_domain_model_message (

	date int(11) DEFAULT '0' NOT NULL,
	author varchar(255) DEFAULT '' NOT NULL,
	headline varchar(255) DEFAULT '' NOT NULL,
	text text,
    seen_by int(11) DEFAULT '0' NOT NULL,

);

CREATE TABLE tx_pxamessagebox_message_feuser_mm (
    uid_local int(11) DEFAULT '0' NOT NULL,
    uid_foreign int(11) DEFAULT '0' NOT NULL,
    sorting int(11) DEFAULT '0' NOT NULL,

    KEY uid_local (uid_local),
    KEY uid_foreign (uid_foreign)
);
