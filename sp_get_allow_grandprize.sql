DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_allow_grandprize`()
    NO SQL
SELECT
	*
FROM (
	SELECT
		a.registration_id,
		b.addon AS registration_date,
		b.participant_id,
		c.participant_name,
		c.participant_email,
		c.participant_wa,
		c.participant_qr,
		COUNT(a.booth_id) AS total_booth
	FROM idm_exhibition.tr_attendance a
	LEFT JOIN idm_exhibition.tr_registration b ON a.registration_id = b.registration_id
	LEFT JOIN idm_exhibition.tab_participants c ON b.participant_id = c.participant_id
	GROUP BY a.registration_id
) t1
WHERE t1.total_booth >= 4 AND t1.registration_id NOT IN (
	SELECT DISTINCT registration_id FROM idm_exhibition.tr_grandprize
)$$
DELIMITER ;
