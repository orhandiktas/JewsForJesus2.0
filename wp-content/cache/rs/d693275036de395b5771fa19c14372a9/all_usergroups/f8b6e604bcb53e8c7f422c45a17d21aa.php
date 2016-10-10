<?php
/*YToxOntzOjMyOiJiODYzMjNhNzNhNGVjYzY3YmNhMTRmNDFkNzc1MDc5NCI7YToxMDp7aTowO086ODoic3RkQ2xhc3MiOjQ6e3M6MjoiSUQiO3M6MToiNyI7czoxMjoiZGlzcGxheV9uYW1lIjtzOjExOiJbQW5vbnltb3VzXSI7czo4OiJkZXNjcmlwdCI7czozMToiQW5vbnltb3VzIHVzZXJzIChub3QgbG9nZ2VkIGluKSI7czo3OiJtZXRhX2lkIjtzOjc6IndwX2Fub24iO31pOjE7Tzo4OiJzdGRDbGFzcyI6NDp7czoyOiJJRCI7czoxOiI4IjtzOjEyOiJkaXNwbGF5X25hbWUiO3M6Mjc6IltQZW5kaW5nIFJldmlzaW9uIE1vbml0b3JzXSI7czo4OiJkZXNjcmlwdCI7czo3MToiQWRtaW5pc3RyYXRvcnMgLyBQdWJsaXNoZXJzIHRvIG5vdGlmeSAoYnkgZGVmYXVsdCkgb2YgcGVuZGluZyByZXZpc2lvbnMiO3M6NzoibWV0YV9pZCI7czoyODoicnZfcGVuZGluZ19yZXZfbm90aWNlX2VkX25yXyI7fWk6MjtPOjg6InN0ZENsYXNzIjo0OntzOjI6IklEIjtzOjE6IjkiO3M6MTI6ImRpc3BsYXlfbmFtZSI7czoyOToiW1NjaGVkdWxlZCBSZXZpc2lvbiBNb25pdG9yc10iO3M6ODoiZGVzY3JpcHQiO3M6Nzg6IkFkbWluaXN0cmF0b3JzIC8gUHVibGlzaGVycyB0byBub3RpZnkgd2hlbiBhbnkgc2NoZWR1bGVkIHJldmlzaW9uIGlzIHB1Ymxpc2hlZCI7czo3OiJtZXRhX2lkIjtzOjMwOiJydl9zY2hlZHVsZWRfcmV2X25vdGljZV9lZF9ucl8iO31pOjM7Tzo4OiJzdGRDbGFzcyI6NDp7czoyOiJJRCI7czoxOiIxIjtzOjEyOiJkaXNwbGF5X25hbWUiO3M6MTg6IltXUCBhZG1pbmlzdHJhdG9yXSI7czo4OiJkZXNjcmlwdCI7czo1MjoiQWxsIHVzZXJzIHdpdGggdGhlIFdvcmRQcmVzcyBhZG1pbmlzdHJhdG9yIGJsb2cgcm9sZSI7czo3OiJtZXRhX2lkIjtzOjIxOiJ3cF9yb2xlX2FkbWluaXN0cmF0b3IiO31pOjQ7Tzo4OiJzdGRDbGFzcyI6NDp7czoyOiJJRCI7czoxOiIyIjtzOjEyOiJkaXNwbGF5X25hbWUiO3M6MTE6IltXUCBhdXRob3JdIjtzOjg6ImRlc2NyaXB0IjtzOjQ1OiJBbGwgdXNlcnMgd2l0aCB0aGUgV29yZFByZXNzIGF1dGhvciBibG9nIHJvbGUiO3M6NzoibWV0YV9pZCI7czoxNDoid3Bfcm9sZV9hdXRob3IiO31pOjU7Tzo4OiJzdGRDbGFzcyI6NDp7czoyOiJJRCI7czoxOiIzIjtzOjEyOiJkaXNwbGF5X25hbWUiO3M6MTY6IltXUCBjaGllZmp1aWNlcl0iO3M6ODoiZGVzY3JpcHQiO3M6NTA6IkFsbCB1c2VycyB3aXRoIHRoZSBXb3JkUHJlc3MgY2hpZWZqdWljZXIgYmxvZyByb2xlIjtzOjc6Im1ldGFfaWQiO3M6MTk6IndwX3JvbGVfY2hpZWZqdWljZXIiO31pOjY7Tzo4OiJzdGRDbGFzcyI6NDp7czoyOiJJRCI7czoxOiI0IjtzOjEyOiJkaXNwbGF5X25hbWUiO3M6MTY6IltXUCBjb250cmlidXRvcl0iO3M6ODoiZGVzY3JpcHQiO3M6NTA6IkFsbCB1c2VycyB3aXRoIHRoZSBXb3JkUHJlc3MgY29udHJpYnV0b3IgYmxvZyByb2xlIjtzOjc6Im1ldGFfaWQiO3M6MTk6IndwX3JvbGVfY29udHJpYnV0b3IiO31pOjc7Tzo4OiJzdGRDbGFzcyI6NDp7czoyOiJJRCI7czoxOiI1IjtzOjEyOiJkaXNwbGF5X25hbWUiO3M6MTE6IltXUCBlZGl0b3JdIjtzOjg6ImRlc2NyaXB0IjtzOjQ1OiJBbGwgdXNlcnMgd2l0aCB0aGUgV29yZFByZXNzIGVkaXRvciBibG9nIHJvbGUiO3M6NzoibWV0YV9pZCI7czoxNDoid3Bfcm9sZV9lZGl0b3IiO31pOjg7Tzo4OiJzdGRDbGFzcyI6NDp7czoyOiJJRCI7czoyOiIxMCI7czoxMjoiZGlzcGxheV9uYW1lIjtzOjI4OiJbV1AgZWVfZXZlbnRzX2FkbWluaXN0cmF0b3JdIjtzOjg6ImRlc2NyaXB0IjtzOjYyOiJBbGwgdXNlcnMgd2l0aCB0aGUgV29yZFByZXNzIGVlX2V2ZW50c19hZG1pbmlzdHJhdG9yIGJsb2cgcm9sZSI7czo3OiJtZXRhX2lkIjtzOjMxOiJ3cF9yb2xlX2VlX2V2ZW50c19hZG1pbmlzdHJhdG9yIjt9aTo5O086ODoic3RkQ2xhc3MiOjQ6e3M6MjoiSUQiO3M6MToiNiI7czoxMjoiZGlzcGxheV9uYW1lIjtzOjE1OiJbV1Agc3Vic2NyaWJlcl0iO3M6ODoiZGVzY3JpcHQiO3M6NDk6IkFsbCB1c2VycyB3aXRoIHRoZSBXb3JkUHJlc3Mgc3Vic2NyaWJlciBibG9nIHJvbGUiO3M6NzoibWV0YV9pZCI7czoxODoid3Bfcm9sZV9zdWJzY3JpYmVyIjt9fX0=*/
?>