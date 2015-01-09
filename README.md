# 4D-Data-Visualizer
January 8, 2015

This is a JavaScript application that I developed to visualize 4D data (3D data with time). 
It was designedin particular to visualize data from a gold heap leach optimization program that runs on GoldSim.  The data outputs from GoldSim in Excel format.  I tried to preserve the GoldSim format for each data type to make it easier to transfer to MySQL. 

Current working version runs off of a MySQL server. You will need to provide your own MySQL server to house your data.  

Other past versions were 'standalone' local machine versions that used the Access.js library to query an Access database.  This makes it much easier to transfer from Excel to Access, but security problems in browsers make the software difficult to share with others as browser settings must be set on individual machines. 

Currently the model maximum dimensions are 36x41x15 but this can be adjusted in further versions.

I'm open to suggestions on how to make the application more efficient. Please let me know! 
