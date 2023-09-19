import json
import uuid
import sys
from medisearch_client import MediSearchClient

# Set your API key here
api_key = "85c92678-0fac-4f60-b02c-9400ca591b9e"
client = MediSearchClient(api_key=api_key)

def search(query):
    # Create a conversation ID
    conversation_id = str(uuid.uuid4())

    # Send the query to MediSearch
    responses = client.send_user_message(
        conversation=[query],
        conversation_id=conversation_id,
        language="English",
        should_stream_response=True,
    )

    text_response = ""
    for response in responses:
        if response["event"] == "llm_response":
            text_response = response["text"]

    # Prepare JSON response
    response_data = {"text": text_response}
    return json.dumps(response_data)

if __name__ == "__main__":
    # Get the query from the command-line arguments
    query = sys.argv[1]

    # Perform the search and print the JSON response
    result = search(query)
    print(result)
